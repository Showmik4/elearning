<?php
namespace App\Http\Controllers;
use App\Mail\AccountActive;
use App\Mail\AccountInactive;
use App\Models\Address;
use App\Models\Customer;
use App\Models\District;
use App\Models\Location;
use App\Models\Reseller;
use App\Models\ShipmentZone;
use App\Models\User;
use App\Traits\ImageTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    use ImageTrait;

    public function show()
    {
        return view('customer.index');
    }

    /**
     * @throws Exception
     */
    public function list()
    {
        $customer = User::where('fkUserTypeId', 2)->get();
        return datatables()->of($customer)
            ->addColumn('name', function (User $customer) {
                return @$customer->firstName . ' ' . @$customer->lastName;
            })
            ->addColumn('created_at', function (User $customer) {
                return date('Y-m-d', strtotime($customer->created_at));
            })

            // ->addColumn('status', function (User $customer){
            //     if ($customer->status === 'active') {
            //         return '<label class="btn btn-success">Active</label>';
            //     }
            //     return '<label class="btn btn-danger">Inactive</label>';
            // })
            ->addColumn('status', function (User $customer) {
                $btn = '';
                if ($customer->status == 'active') {
                    $btn = $btn . '<a title="edit" class="btn btn-success" data-panel-id="' . $customer->userId . '" onclick="changeStatus(this)">Active</a>';
                } else {
                    $btn = $btn . '<a title="edit" class="btn btn-warning" data-panel-id="' . $customer->userId . '" onclick="changeStatus(this)">Inactive</a>';
                }
                return $btn;
            })
            ->setRowAttr([
                'align' => 'center',
            ])
            ->rawColumns(['name', 'status', 'created_at'])
            ->make(true);
    }

    public function statusUpdate(Request $request)
    {
        $customer = User::find($request->id);
        if ($customer) {
            $customer->status = ($customer->status == 'active') ? 'inactive' : 'active';
            $customer->save();
            if ($customer->status == 'active') {
                Mail::to($customer->email)->send(new AccountActive($customer));
            } else {
                Mail::to($customer->email)->send(new AccountInactive($customer));
            }

            return response()->json(['status' => $customer->status]);
        }
        return response()->json(['error' => 'Customer not found'], 404);
    }

    public function create()
    {
        $shipmentZones = ShipmentZone::query()->where('status', 'active')->get();
        $district = District::all();
        $location = Location::all();
        $reseller = Reseller::all();
        return view('customer.create', compact('shipmentZones', 'district', 'location', 'reseller'));
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $validated = $this->validate($request, [
            'firstName' => 'required|string|max:50',
            'lastName' => 'nullable|string|max:50',
            'phone' => 'required|string|max:20|unique:user',
            'email' => 'nullable|email|max:50|unique:user',
            'billingAddress' => 'nullable|string',
            'locationId' => 'nullable',
            'districtId' => 'nullable',
            'reseller_id' => 'nullable',
            'status' => 'required|string|max:45',
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::query()->create([
                'firstName' => $validated['firstName'],
                'lastName' => $validated['lastName'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'password' => Hash::make('12345678'),
                'fkUserTypeId' => 2,
            ]);
            Customer::query()->create([
                'fkUserId' => $user->userId,
                'phone' => $validated['phone'],
                'billing_address' => $validated['billingAddress'],
                'locationId' => $validated['locationId'],
                'districtId' => $validated['districtId'],
                'reseller_id' => $validated['reseller_id'],
                'status' => $validated['status'],
            ]);
        });

        Session::flash('success', 'Customer Created Successfully!');
        return redirect()->route('customer.show');
    }

    public function findLocation(Request $request)
    {
        // dd($request->all());
        $location = Location::where('districtId', $request->districtId)->get();
        // dd($location);
        return response()->json(['location' => $location]);
    }

    public function edit($customerId)
    {
        $customer = Customer::with('user', 'address')->where('customerId', $customerId)->first();
        $shipmentZones = ShipmentZone::query()->where('status', 'active')->get();
        $district = District::all();
        $location = Location::all();
        $reseller = Reseller::all();
        return view('customer.edit', compact('customer', 'shipmentZones', 'district', 'location', 'reseller'));
    }

    public function update(Request $request, $customerId): RedirectResponse
    {
        // dd($request->all());
        $customer = Customer::query()->where('customerId', $customerId)->first();

        if (!empty($customer)) {
            $user = User::query()->where('userId', $customer->fkUserId)->first();

            // dd($user);

            if (!empty($user)) {
                $validated = $this->validate($request, [
                    'firstName' => 'required|string|max:50',
                    'lastName' => 'nullable|string|max:50',
                    'phone' => 'required|string|max:20|unique:user,phone,' . $user->userId . ',userId',
                    'email' => 'nullable|email|max:50|unique:user,email,' . $user->userId . ',userId',
                    // 'customerImage' => 'nullable|image|mimes:jpeg,png,jpg',
                    'billing_address' => 'nullable|string',
                    'districtId' => 'nullable',
                    'locationId' => 'nullable',
                    'reseller_id' => 'nullable',
                    'status' => 'required|string|max:45',
                ]);

                DB::transaction(function () use ($validated, $customer, $user) {

                    $user->update([
                        'firstName' => $validated['firstName'],
                        'lastName' => $validated['lastName'],
                        'phone' => $validated['phone'],
                        'email' => $validated['email'],
                        'password' => $user->password ?? Hash::make('12345678'),
                        'fkUserTypeId' => 2,
                    ]);

                    $customer->update([
                        'phone' => $validated['phone'],
                        'billing_address' => $validated['billing_address'],
                        'districtId' => $validated['districtId'],
                        'locationId' => $validated['locationId'],
                        'reseller_id' => $validated['reseller_id'],
                        'status' => $validated['status'],
                    ]);
                });
            }
        }

        Session::flash('success', 'Customer Updated Successfully!');
        return redirect()->route('customer.show');
    }

    public function delete(Request $request): JsonResponse
    {
        $customer = Customer::query()->where('customerId', $request->customerId)->first();
        if (!empty($customer)) {
            $customer->delete();
        }
        return response()->json();
    }

}
