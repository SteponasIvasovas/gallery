@extends('layouts/user')
@section('user-content')
  <div id="user-profile-container">
    <div class="">
      <label for="">Name: </label>
      <input id="user-fullname" type="text" value="{{$user->firstname}} {{$user->lastname}}" disabled></input>
    </div>
    <div class="">
      <label for="">Gender: </label>
      <select id="user-gender" name="" disabled>
        <option value="1" @if ($user->gender == "male") selected @endif>male</option>
        <option value="2" @if ($user->gender == "female") selected @endif>female</option>
      </select>
    </div>
    <div class="">
      <label for="">Birthday: </label>
      <input id="user-birthday" type="date" value="{{$user->birthday}}" disabled></input>
    </div>
    <div class="">
      <label for="">Country: </label>
      <input id="user-county" type="text" value="{{$user->country}}" disabled></input>
    </div>
    <div class="">
      <label for="">City: </label>
      <input id="user-city" type="text" value="{{$user->city}}" disabled></input>
    </div>
    <label for="">About :</label>
    <textarea id="user-about" disabled>{{$user->about}}</textarea>
    <div class="">
      <button type="submit">Save changes</button>
      <button type="button">Cancel</button>
    </div>
  </div>
@endsection
