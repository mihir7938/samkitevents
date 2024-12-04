<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UploadImageService;
use App\Services\UserService;
use App\Services\EventService;
use App\Services\DayService;
use App\Services\YatrikService;
use App\Services\YatraService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Imports\ImportYatrik;
use App\Models\Event;

class AdminController extends Controller {

	private $imageService, $userService, $eventService, $dayService, $yatrikService, $yatraService;

    public function __construct( 
    	UploadImageService $imageService,
        UserService $userService,
        EventService $eventService,
        DayService $dayService,
        YatrikService $yatrikService,
        YatraService $yatraService
    )
    {
    	$this->imageService = $imageService;
        $this->userService = $userService;
        $this->eventService = $eventService;
        $this->dayService = $dayService;
        $this->yatrikService = $yatrikService;
        $this->yatraService = $yatraService;
    }
    public function index(Request $request)
    {
        return view('admin.index');
    }
    public function getUsers()
    {
        $users = $this->userService->getAllUsers();
        return view('admin.users.index')->with('users', $users);
    }
    public function addUser()
    {
        $roles = $this->userService->getAllRoles();
        return view('admin.users.add')->with('roles', $roles);
    }
    public function saveUser(Request $request)
    {
        $user = $this->userService->create($request);
        $request->session()->put('message', 'User has been added successfully.');
        $request->session()->put('alert-type', 'alert-success');
        return redirect()->route('admin.users');
    }
    public function editUser(Request $request, $id)
    {
        try{
            $user = $this->userService->getUserById($id);
            $roles = $this->userService->getAllRoles();
            if(!$user){
                throw new BadRequestException('Invalid Request id');
            }
            return view('admin.users.edit')->with('user', $user)->with('roles', $roles);
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.users');
        }
    }
    public function updateUser(Request $request)
    {
        try{
            $user = $this->userService->getUserById($request->id);
            if(!$user){
                throw new BadRequestException('Invalid Request id');
            }
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['role_id'] = $request->role;
            $data['status'] = $request->active;
            $this->userService->update($user, $data);
            $request->session()->put('message', 'User has been updated successfully.');
            $request->session()->put('alert-type', 'alert-success');
            return redirect()->route('admin.users');
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.users');
        }
    }
    public function deleteUser(Request $request, $id)
    {
        try{
            $user = $this->userService->getUserById($id);
            if(!$user){
                throw new BadRequestException('Invalid Request id.');
            }
            $this->userService->delete($user);
            $request->session()->put('message', 'User has been deleted successfully.');
            $request->session()->put('alert-type', 'alert-success');
            return redirect()->route('admin.users');
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.users');
        }
    }
    public function changePassword(Request $request, $id)
    {
        try{
            $user = $this->userService->getUserById($id);
            if(!$user){
                throw new BadRequestException('Invalid Request id');
            }
            return view('admin.users.change-password')->with('user', $user);
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.users');
        }
    }
    public function updateChangePassword(Request $request)
    {
        try {
            $user = $this->userService->getUserById($request->id);
            if ($user) {
                $data['password'] = Hash::make($request->password);
                $this->userService->update($user, $data);
                $request->session()->put('message', 'Password has been changed successfully.');
                $request->session()->put('alert-type', 'alert-success');
                return redirect()->route('admin.users');
            }
        } catch (\Exception $e) {
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.users');
        }
    }
    public function getEvents()
    {
        $events = $this->eventService->getAllEvents();
        return view('admin.events.index')->with('events', $events);
    }
    public function addEvent()
    {
        return view('admin.events.add');
    }
    public function saveEvent(Request $request)
    {
        $diff = strtotime(date("Y-m-d", strtotime(str_replace('/', '-', $request->end_date)))) - strtotime(date("Y-m-d", strtotime(str_replace('/', '-', $request->start_date))));
        $total_days = floor($diff / (60 * 60 * 24));
        $data['name'] = $request->name;
        $data['start_date'] = date("Y-m-d", strtotime(str_replace('/', '-', $request->start_date)));
        $data['end_date'] = date("Y-m-d", strtotime(str_replace('/', '-', $request->end_date)));
        $total_days = $total_days + 1;
        $data['total_days'] = $total_days;
        $data['created_by'] = Auth::user()->id;
        $eventdata = $this->eventService->create($data);
        for($i=1; $i<=$total_days; $i++) {
            $daydata['event_id'] = $eventdata->id;
            $daydata['name'] = 'Day '.$i;
            $daydata['created_by'] = Auth::user()->id;
            $this->dayService->create($daydata);
        }
        $request->session()->put('message', 'Event has been added successfully.');
        $request->session()->put('alert-type', 'alert-success');
        return redirect()->route('admin.events');
    }
    public function editEvent(Request $request, $id)
    {
        try{
            $event = $this->eventService->getEventById($id);
            if(!$event){
                throw new BadRequestException('Invalid Request id');
            }
            return view('admin.events.edit')->with('event', $event);
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.events');
        }
    }
    public function updateEvent(Request $request)
    {
        try{
            $event = $this->eventService->getEventById($request->id);
            if(!$event){
                throw new BadRequestException('Invalid Request id');
            }
            $data['name'] = $request->name;
            /*$diff = strtotime(date("Y-m-d", strtotime(str_replace('/', '-', $request->end_date)))) - strtotime(date("Y-m-d", strtotime(str_replace('/', '-', $request->start_date))));
            $total_days = floor($diff / (60 * 60 * 24));
            $data['start_date'] = date("Y-m-d", strtotime(str_replace('/', '-', $request->start_date)));
            $data['end_date'] = date("Y-m-d", strtotime(str_replace('/', '-', $request->end_date)));
            $data['total_days'] = $total_days;*/
            $data['updated_by'] = Auth::user()->id;
            $this->eventService->update($event, $data);
            /*$event->event_all_days()->delete();
            for($i=1; $i<=$total_days; $i++) {
                $daydata['event_id'] = $request->id;
                $daydata['name'] = 'Day '.$i;
                $daydata['created_by'] = Auth::user()->id;
                $this->dayService->create($daydata);
            }*/
            $request->session()->put('message', 'Event has been updated successfully.');
            $request->session()->put('alert-type', 'alert-success');
            return redirect()->route('admin.events');
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.events');
        }
    }
    public function deleteEvent(Request $request, $id)
    {
        try{
            $event = $this->eventService->getEventById($id);
            if(!$event){
                throw new BadRequestException('Invalid Request id.');
            }
            $event->event_all_days()->delete();
            $this->eventService->delete($event);
            $request->session()->put('message', 'Event has been deleted successfully.');
            $request->session()->put('alert-type', 'alert-success');
            return redirect()->route('admin.events');
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.events');
        }
    }
    public function listEventDays(Request $request, $id)
    {
        try{
            $event = $this->eventService->getEventById($id);
            if(!$event){
                throw new BadRequestException('Invalid Request id');
            }
            $days = $event->event_all_days()->orderBy('name')->get();
            return view('admin.events.list')->with('days', $days);
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.events');
        }
    }
    public function editEventDay(Request $request, $id)
    {
        try{
            $day = $this->dayService->getDayById($id);
            if(!$day){
                throw new BadRequestException('Invalid Request id');
            }
            return view('admin.events.day')->with('day', $day);
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->back();
        }
    }
    public function updateEventDay(Request $request)
    {
        try{
            $day = $this->dayService->getDayById($request->id);
            if(!$day){
                throw new BadRequestException('Invalid Request id');
            }
            $data['route_name'] = $request->route_name;
            $data['updated_by'] = Auth::user()->id;
            $this->dayService->update($day, $data);
            $request->session()->put('message', 'Route Name has been updated successfully.');
            $request->session()->put('alert-type', 'alert-success');
            return redirect()->route('admin.events.list', ['id' => $day->event->id]);
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->back();
        }
    }
    public function getYatriks()
    {
        $yatriks = $this->yatrikService->getAllYatriks();
        return view('admin.yatriks.index')->with('yatriks', $yatriks);
    }
    public function addYatrik()
    {
        $events = $this->eventService->getAllEvents();
        return view('admin.yatriks.add')->with('events', $events);
    }
    public function saveYatrik(Request $request)
    {
        $randomNumber = random_int(1000, 9999);
        $member_id = $randomNumber."-".substr($request->phone, -5);
        $data['member_id'] = $member_id;
        $data['event_id'] = $request->event_name;
        $data['custom_yatrik_id'] = $request->yatrik_id;
        $data['name'] = $request->name;
        $data['gender'] = $request->gender;
        $data['age'] = $request->age;
        $data['aadhar_number'] = $request->aadhar_number;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['state'] = $request->state;
        $data['country'] = $request->country;
        $data['religious_method'] = $request->religious_method;
        $data['father_husband_name'] = $request->father_husband_name;
        $data['reference'] = $request->reference;
        $data['mobile_number'] = $request->phone;
        $data['emergency_number'] = $request->emergency;
        $data['email'] = $request->email;
        $data['illness'] = $request->illness;
        $data['_99_yatra'] = $request->_99_yatra;
        $data['_12_gaon_chari_palit_sangh_yatra'] = $request->_12_gaon_chari_palit_sangh_yatra;
        $data['present_penance'] = $request->present_penance;
        $file = $request->image;
        $extension = $file->getClientOriginalExtension();
        $customfilename = $member_id.'.'.$extension;
        $filename = $this->imageService->uploadFileWithCustomName($file, "assets/yatriks/profile_photo", $customfilename);
        $data['profile_photo'] = '/yatriks/profile_photo/'.$customfilename;
        $qr_code_path = public_path("assets/yatriks/qr_code/".$member_id.".png");
        $qr_code = \QrCode::format('png')->size(250)->generate($member_id, $qr_code_path);
        $data['qr_code'] = '/yatriks/qr_code/'.$member_id.'.png';
        $data['created_by'] = Auth::user()->id;
        $this->yatrikService->create($data);
        $request->session()->put('message', 'Yatrik has been added successfully.');
        $request->session()->put('alert-type', 'alert-success');
        return redirect()->route('admin.yatriks');
    }
    public function editYatrik(Request $request, $id)
    {
        try{
            $yatrik = $this->yatrikService->getYatrikById($id);
            if(!$yatrik){
                throw new BadRequestException('Invalid Request id');
            }
            $events = $this->eventService->getAllEvents();
            return view('admin.yatriks.edit')->with('yatrik', $yatrik)->with('events', $events);
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.yatriks');
        }
    }
    public function updateYatrik(Request $request)
    {
        try{
            $yatrik = $this->yatrikService->getYatrikById($request->id);
            if(!$yatrik){
                throw new BadRequestException('Invalid Request id');
            }
            $member_id = $yatrik->member_id;
            $data['event_id'] = $request->event_name;
            $data['custom_yatrik_id'] = $request->yatrik_id;
            $data['name'] = $request->name;
            $data['gender'] = $request->gender;
            $data['age'] = $request->age;
            $data['aadhar_number'] = $request->aadhar_number;
            $data['address'] = $request->address;
            $data['city'] = $request->city;
            $data['state'] = $request->state;
            $data['country'] = $request->country;
            $data['religious_method'] = $request->religious_method;
            $data['father_husband_name'] = $request->father_husband_name;
            $data['reference'] = $request->reference;
            $data['mobile_number'] = $request->phone;
            $data['emergency_number'] = $request->emergency;
            $data['email'] = $request->email;
            $data['illness'] = $request->illness;
            $data['_99_yatra'] = $request->_99_yatra;
            $data['_12_gaon_chari_palit_sangh_yatra'] = $request->_12_gaon_chari_palit_sangh_yatra;
            $data['present_penance'] = $request->present_penance;
            if($request->has('image')){
                $file = $request->image;
                $extension = $file->getClientOriginalExtension();
                $customfilename = $member_id.'.'.$extension;
                $filename = $this->imageService->uploadFileWithCustomName($file, "assets/yatriks/profile_photo", $customfilename);
                $data['profile_photo'] = '/yatriks/profile_photo/'.$customfilename;
            }
            $qr_code_path = public_path("assets/yatriks/qr_code/".$member_id.".png");
            $qr_code = \QrCode::format('png')->size(250)->generate($member_id, $qr_code_path);
            $data['qr_code'] = '/yatriks/qr_code/'.$member_id.'.png';
            $data['updated_by'] = Auth::user()->id;
            $this->yatrikService->update($yatrik, $data);
            $request->session()->put('message', 'Yatrik has been updated successfully.');
            $request->session()->put('alert-type', 'alert-success');
            return redirect()->route('admin.yatriks');
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.yatriks');
        }
    }
    public function deleteYatrik(Request $request, $id)
    {
        try{
            $yatrik = $this->yatrikService->getYatrikById($id);
            if(!$yatrik){
                throw new BadRequestException('Invalid Request id.');
            }
            $filepath = public_path('assets/' . $yatrik->profile_photo);
            $this->imageService->deleteFile($filepath);
            $qr_code_filepath = public_path('assets/' . $yatrik->qr_code);
            $this->imageService->deleteFile($qr_code_filepath);
            $this->yatrikService->delete($yatrik);
            $request->session()->put('message', 'Yatrik has been deleted successfully.');
            $request->session()->put('alert-type', 'alert-success');
            return redirect()->route('admin.yatriks');
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.yatriks');
        }
    }
    public function viewYatrik(Request $request, $id)
    {
        try{
            $yatrik = $this->yatrikService->getYatrikById($id);
            if(!$yatrik){
                throw new BadRequestException('Invalid Request id');
            }
            return view('admin.yatriks.view')->with('yatrik', $yatrik);
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.yatriks');
        }
    }
    public function importYatriks()
    {
        $events = $this->eventService->getAllEvents();
        return view('admin.yatriks.import')->with('events', $events);
    }
    public function saveImportYatriks(Request $request)
    {
        $not_imported = [];
        $error_msg = '';
        $i = 2;
        $file = $request->file('file');
        $row_array = Excel::toArray(new ImportYatrik, $file)[0];
        foreach($row_array as $array) {
            if ($array['name'] && $array['mobile_number'] && is_numeric($array['mobile_number'])) {
                $randomNumber = random_int(1000, 9999);
                $member_id = $randomNumber."-".substr($array['mobile_number'], -5);
                $data['member_id'] = $member_id;
                $data['event_id'] = $request->event_name;
                $data['custom_yatrik_id'] = $array['yatrik_id'];
                $data['name'] = $array['name'];
                $data['gender'] = $array['gender'];
                $data['age'] = $array['age'];
                $data['aadhar_number'] = $array['aadhar_number'];
                $data['address'] = $array['address'];
                $data['city'] = $array['city'];
                $data['state'] = $array['state'];
                $data['country'] = $array['country'];
                $data['religious_method'] = $array['religious_method'];
                $data['father_husband_name'] = $array['father_husband_name'];
                $data['reference'] = $array['reference'];
                $data['mobile_number'] = $array['mobile_number'];
                $data['emergency_number'] = $array['emergency_number'];
                $data['email'] = $array['email'];
                $data['illness'] = $array['illness'];
                if($array['99_yatra'] == 'Yes') {
                    $_99_yatra = 1;
                } else {
                    $_99_yatra = 0;
                }
                $data['_99_yatra'] = $_99_yatra;
                if($array['12_gaon_chari_palit_sangh_yatra'] == 'Yes') {
                    $_12_gaon_chari_palit_sangh_yatra = 1;
                } else {
                    $_12_gaon_chari_palit_sangh_yatra = 0;
                }
                $data['_12_gaon_chari_palit_sangh_yatra'] = $_12_gaon_chari_palit_sangh_yatra;
                $data['present_penance'] = $array['present_penance'];
                $qr_code_path = public_path("assets/yatriks/qr_code/".$member_id.".png");
                $qr_code = \QrCode::format('png')->size(250)->generate($member_id, $qr_code_path);
                $data['qr_code'] = '/yatriks/qr_code/'.$member_id.'.png';
                $data['created_by'] = Auth::user()->id;
                $this->yatrikService->create($data);
            } else {
                $not_imported[] = $i;
            }
            $i++;
        }
        $error_msg = 'Row Number ('.implode(',',$not_imported).') not imported from excel file';
        $request->session()->put('message', 'Yatriks has been imported successfully.');
        $request->session()->put('alert-type', 'alert-success');
        if($not_imported) {
            return redirect()->route('admin.yatriks.import')->withErrors($error_msg);
        } else {
            return redirect()->route('admin.yatriks.import');
        }
    }
    public function assignYatriks()
    {
        $yatriks = [];
        $days = [];
        $event_id = '';
        $events = $this->eventService->getAllEvents();
        return view('admin.yatriks.assign')->with('events', $events)->with('yatriks', $yatriks)->with('days', $days)->with('event_id', $event_id);
    }
    public function fetchYatriksByEvent(Request $request)
    {
        $yatriks = $this->yatrikService->fetchYatriksByEvent($request->event_id);
        $days = $this->dayService->fetchDaysByEvent($request->event_id);
        return view('admin.yatriks.fetch-yatriks')->with('yatriks', $yatriks)->with('days', $days)->with('event_id', $request->event_id)->render();
    }
    public function saveAssignYatriks(Request $request)
    {
        try{
            $yatriks = $this->yatrikService->fetchYatriksByEvent($request->event_id);
            foreach($yatriks as $yatrik) {
                $data['yatrik_id'] = $yatrik->id;
                $data['event_id'] = $request->event_id;
                $data['day_id'] = $request->day_name;
                $data['created_by'] = Auth::user()->id;
                $this->yatraService->create($data);
            }
            $request->session()->put('message', 'All Yatriks have been successfully assigned.');
            $request->session()->put('alert-type', 'alert-success');
            return redirect()->route('admin.yatriks.assign');
        }catch(\Exception $e){
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('admin.yatriks.assign');
        }
    }
}