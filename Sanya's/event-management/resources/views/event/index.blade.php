@extends('layouts.app')

@section('title', 'Event Management')

@section('content')
    <div class="container">
        <label class="theme-switch">
            <i class="fa-solid fa-sun" id="sun-icon"></i>
            <input type="checkbox" id="theme-toggle">
            <span class="slider"></span>
            <i class="fa-solid fa-moon" id="moon-icon"></i>
        </label>

        <p class="cross">
            <i class="fa-solid fa-xmark" style="color: #FFD43B; font-size: xx-large;"></i>
        </p>

        <h1 class="login">Sign In</h1>
        <br>
        <br>
        <p class="para">Please enter your username and password</p>
        <br>
        <input class="input1" type="username" placeholder="Username" required>
        <br>
        <br>
        <br>
        <input class="input2" id="password" type="password" placeholder="Enter Password" oninput="password_strength()">
        <div id="Password_strength_status"></div>
        <br>
        <p class="para2">Forgot<span> <a href="forgot_password.html">password?</a></span></p>
        <br>
        <button class="button" type="submit">Sign In</button>
        <p>Or Sign In with</p>
        <img src="google-icon-1.png">
    </div>

@endsection

