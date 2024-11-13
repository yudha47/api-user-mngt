<?php

namespace App\Http\Controllers;

use App\Models\listMenu;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  public function list_menu(){
    $menu = listMenu::select('*')->orderBy('position_number')->get();
    $response = [
        'responseCode' => 200000,
        'responseMessage' => 'Success',
        'responseData' => $menu
    ];
    
    return response()->json($response, 200);
  }

  public function update_setting(Request $request){

    // Update Logo
    if($request->logo != '' || $request->logo != null){
      $logo_name = str_replace(' ', '', $request->logo->getClientOriginalName());
      $request->logo->move(public_path('uploads/'), $logo_name);
      Setting::where('id', 1)->update([
        "logo" => $logo_name
      ]);
    }

    // Update Background
    if($request->background != '' || $request->background != null){
      $background_name = str_replace(' ', '', $request->background->getClientOriginalName());
      $request->background->move(public_path('uploads/'), $background_name);
      Setting::where('id', 1)->update([
        "background" => $background_name
      ]);
    }

    // Update Menu Dashboard
    if($request->menu_dashboard != '' || $request->menu_dashboard != null){
      listMenu::where('id', 1)->update([
        'position_number' => $request->menu_dashboard,
      ]);
    }

    if($request->icon_menu_dashboard != '' || $request->icon_menu_dashboard != null){
      listMenu::where('id', 1)->update([
        'default_icon' => $request->icon_menu_dashboard,
      ]);
    }

    // Update Menu User
    if($request->menu_user != '' || $request->menu_user != null){
      listMenu::where('id', 2)->update([
        'position_number' => $request->menu_user,
      ]);
    }

    if($request->icon_menu_user != '' || $request->icon_menu_user != null){
      listMenu::where('id', 2)->update([
        'default_icon' => $request->icon_menu_user,
      ]);
    }

    // Update Menu Logout
    if($request->menu_logout != '' || $request->menu_logout != null){
      listMenu::where('id', 3)->update([
        'position_number' => $request->menu_logout,
      ]);
    }

    if($request->icon_menu_logout != '' || $request->icon_menu_logout != null){
      listMenu::where('id', 3)->update([
        'default_icon' => $request->icon_menu_logout,
      ]);
    }

    // Update Menu Pengaturan Tampilan
    if($request->menu_setting != '' || $request->menu_setting != null){
      listMenu::where('id', 4)->update([
        'position_number' => $request->menu_setting,
      ]);
    }

    if($request->icon_menu_setting != '' || $request->icon_menu_setting != null){
      listMenu::where('id', 4)->update([
        'default_icon' => $request->icon_menu_setting,
      ]);
    }

    $menu = listMenu::select('*')->get();
    $response = [
        'responseCode' => 200000,
        'responseMessage' => 'Success',
        'responseData' => $menu
    ];
    
    return response()->json($response, 200);
  }

  public function data_image(){
    $image = Setting::select('*')->first();
    $response = [
        'responseCode' => 200000,
        'responseMessage' => 'Success',
        'responseData' => $image
    ];
    
    return response()->json($response, 200);
  }
}
