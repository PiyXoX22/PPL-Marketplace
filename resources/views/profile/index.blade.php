<style>
    .profile-container {
        display: flex;
        padding: 20px;
        background: #f7f7f7;
        min-height: 80vh;
    }
    .sidebar {
        width: 200px;
        background: #e6e6e6;
        padding: 20px;
    }
    .sidebar a {
        display: block;
        padding: 10px;
        margin-bottom: 5px;
        text-decoration: none;
        color: #000;
        font-weight: bold;
    }
    .sidebar a.active {
        background: #000;
        color: #fff;
    }

    .content {
        flex: 1;
        background: #fff;
        padding: 30px;
        margin-left: 20px;
        border-radius: 4px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .row {
        display: flex;
        gap: 20px;
    }
    .col {
        flex: 1;
    }

    .btn-submit {
        padding: 10px 20px;
        background: #222;
        color: #fff;
        border: none;
        border-radius: 4px;
    }

    .avatar-box {
        text-align: center;
        margin-bottom: 20px;
    }
    .avatar-img {
        width: 120px;
        height: 120px;
        background: #ccc;
        border-radius: 4px;
        margin: 0 auto;
    }
</style>

<div class="profile-container">

    {{-- Sidebar --}}
    <div class="sidebar">
        <a href="#" class="active">PROFILE</a>
        <a href="#">ADDRESSES</a>
        <a href="#">ORDERS</a>
        <a href="#">LOGOUT</a>
    </div>

    {{-- Main Content --}}
    <div class="content">
        <h2>User Profile</h2>

        <div class="avatar-box">
            <div class="avatar-img"></div>
            <button class="btn-submit" style="margin-top:10px;">Remove Image</button>
        </div>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label>Password (optional)</label>
                        <input type="password" name="password">
                    </div>

                    <div class="form-group">
                        <label>Receive Email</label>
                        <input type="text" value="Yes" readonly>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}">
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" value="{{ $user->phone }}">
                    </div>

                    <div class="form-group">
                        <label>Re-Password</label>
                        <input type="password" name="password_confirmation">
                    </div>
                </div>
            </div>

            <button class="btn-submit">Save Changes</button>

        </form>
    </div>
</div>
