<?php
namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\Industry;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Address;
use App\Models\UserType;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function customerSearch(Request $data)
    {
        return Customer::where('phone', 'like', "%{$data->phoneNumber}%")->get();
    }

    public function customerData(Request $r)
    {
        $customerData = Customer::with('user', 'address','reseller')->find($r->customerName);       
        return response()->json($customerData);
    }

    public function customerStore(Request $data)
    {      
        $this->validate($data, [
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => ['required', 'string', 'max:20', 'unique:user']
        ]);

        $user = empty($data->id) ? new User() : User::find($data->id);
        $user->firstName = $data->firstName;
        $user->lastName = $data->lastName ?? null;
        $user->email = $data->email ?? null;
        $user->phone = $data->phone ?? null;
        $user->password = null;
        $user->fkUserTypeId = '2';
        $user->save();

        $customer = empty($data->id) ? new Customer() : Customer::where('fkUserId', $data->id)->first();
        $customer->fkUserId = $user->userId;
        $customer->phone = $data->phone;
        $customer->optional_phone = $data->optional_phone;
        $customer->status = 'active';
        $customer->billing_address = $data->billing_address;
        $customer->reseller_id = $data->reseller_id;
        // $customer->shipping_address = $data->shipping_address;
        $customer->save();
        $customerId = $customer->customerId;
        $customerData = Customer::with('user','reseller')->find($customerId);
        return $customerData;
    }

    public function userProfile()
    {
        $user = User::query()->where('userId', Auth::user()->userId)->first();       
        return view('user.profile', compact('user'));
    }

    public function updateUserProfile(Request $request): RedirectResponse
    {
        $user = User::query()->where('userId', Auth::user()->userId)->first();
        if (!empty($user)) {
            $validated = $this->validate($request, [
                'firstName' => 'required|string|max:50',
                'lastName' => 'nullable|string|max:50',              
                'phone' => 'required|string|unique:user,phone,' . $user->userId . ',userId',
                'email' => 'required|string|unique:user,email,' . $user->userId . ',userId',
                'password' => 'required_with:new_password,confirm_password|nullable|string|min:8',
                'new_password' => 'required_with:password,confirm_password|nullable|string|min:8',
                'confirm_password' => 'required_with:password,new_password|same:new_password|nullable|string|min:8',
            ]);

            $user->update([
                'firstName' => $validated['firstName'],
                'lastName' => $validated['lastName'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],              
            ]);

            if (isset($validated['password'], $validated['new_password'], $validated['confirm_password'])) {
                if ($validated['password'] !== $validated['new_password']) {
                    if ($validated['new_password'] === $validated['confirm_password'] && Hash::check($validated['password'], Auth::user()->password)) {
                        $user->update(['password' => bcrypt($validated['new_password'])]);

                        Session::flash('success', 'Password updated successfully!');
                        return redirect()->back();
                    }
                    Session::flash('error', 'Password did not match!');
                    return redirect()->back();
                }
                Session::flash('error', 'Please enter new password!');
                return redirect()->back();
            }

            Session::flash('success', 'User Profile Updated Successfully!');
            return redirect()->back();
        }

        Session::flash('error', 'No user Found!');
        return redirect()->back();
    }

    public function viewEmployee()
    {
        return view('user.index');
    }

    public function employeeList()
    {
        $employee = User::with('userType')->get();      
        
        return datatables()->of($employee)
            ->addColumn('role', function (User $employee) {
                return @$employee->userType->typeName;
            })
          
            ->setRowAttr([
                'align' => 'center',
            ])
            ->rawColumns(['role'])
            ->make(true);
    }   
    public function createEmployee()
    {
        $userType = UserType::all();

        if(auth()->user()->userType->typeName == 'Line Manager')
        {
            $team=Team::where('id',auth()->user()->fk_team_id)->get();
        }

        else
        {
            $team=Team::all();
        }
        
        return view('user.employee_create', compact('userType','team'));
    }

    public function employeeStore(Request $data)
    {       
        $this->validate($data, [
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed|min:4',
            'fkUserTypeId' => 'required',
            'email' => 'required|unique:user,email',
            'status'=>'required',
            // 'fk_team_id'=>'required',
        ]);
        $user = new User();
        $user->firstName = $data->firstName;
        $user->lastName = $data->lastName;
        $user->email = $data->email;
        $user->phone = $data->phone;
        $user->fkuserTypeId = $data->fkUserTypeId;
        $user->password = Hash::make($data->password);
        $user->status=$data->status;  
        // $user->fk_team_id=$data->fk_team_id;      
        $user->save();
        Session::flash('success', 'Employee Created Successfully!');
        return redirect()->route('user.view-employee');
    }

    public function editEmployee($userId)
    {        
        $user = User::query()->where('userId', $userId)->first();
        $userType=UserType::all();
        $team=Team::all();
        return view('user.employee_edit', compact( 'user','userType','team'));
    }

    public function updateEmployee(Request $request,$userId)
    {        
        $validated = $this->validate($request, [
            'firstName' => 'required|string|max:255',
            'lastName' => 'nullable|string|max:255',
            'phone' => 'nullable',
            'email' => 'nullable',
            'fkUserTypeId' => 'nullable',
            'status'=>'nullable',
            // 'fk_team_id'=>'nullable',        
        ]);

        $user = User::query()->where('userId', $userId)->first();
        if(!empty($user)) {         

            $user->update([
                'firstName' => $validated['firstName'],
                'lastName' => $validated['lastName'],
                'phone' => $validated['phone'] ?? null,
                'email' => $validated['email'],
                'fkUserTypeId' =>$validated['fkUserTypeId'],
                'status' =>$validated['status'], 
                // 'fk_team_id'=>$validated['fk_team_id'],               
            ]);
        }
        Session::flash('success', 'Team Member Updated Successfully!');
        return redirect()->route('user.view-employee');
    }

    public function deleteEmployee(Request $request): JsonResponse
    {       
        $employee = User::query()->where('userId', $request->userId)->first();
        if (!empty($employee)) {          
            $employee->delete();
        }
        return response()->json();
    }
}
