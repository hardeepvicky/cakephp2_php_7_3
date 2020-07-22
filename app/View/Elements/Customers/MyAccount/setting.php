<link rel="stylesheet" type="text/css" href="/frontend/css/login.css?9" />
<style>
    body{
        overflow-x: hidden;
    }

    .setting-container
    {
        height: 31em;
    }
    
    .setting-container .wrap-login100
    {
        height: 30em;
    }
    
    .change-password-container
    {
        height: 36em;
    }
    
    .change-password-container .wrap-login100
    {
        height: 35em;
    }

    .input-group{
        padding : 10px 0; 
        margin-bottom: 10px;
    }

    .input-group .name, .input-group .value{
        width : 50%;
        float: left;
        font-size: 1em;
        color : #222;
    }

    .input-group .name{
        width : 35%;
        text-align: right;
        padding-right: 20px;
        font-weight: bold;
    }

    .input-group .value{
        width : 65%;
    }

    .input-group .value:after{
        content: '';
        display: block;
        clear: both;
    }
</style>
<div class="container">
    <div style="width : 350px; margin: 25px auto;">
        <div class="input-group">
            <div class="name">Name</div>
            <div class="value">
                <?= $auth_user["name"] ?>
                <a href="javascript:void(0);" class="setting_change_name" data-value="<?= $auth_user["name"] ?>">Change Name</a>
            </div>
        </div>
        <div class="input-group">
            <div class="name">Username</div>
            <div class="value">
                <?= $auth_user["username"] ?>
                <a href="javascript:void(0);" class="setting_change_username">Change Username</a>
            </div>
        </div>
        <div class="input-group">
            <div class="name">Mobile</div>
            <div class="value">
                <?= $auth_user["mobile_no"] ?>
                <?php if ($auth_user["mobile_no"]): ?>
                    <a href="javascript:void(0);" class="setting_change_mobile">Change Mobile No.</a>
                    <?php if ($auth_user["is_mobile_confirm"]): ?>
                        <span class="label label-success">Confirmed</span>
                    <?php else: ?>
                        <a href="javascript:void(0);">Confirm Now</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="javascript:void(0);" class="setting_change_mobile">Add Mobile No.</a>
                <?php endif; ?>    
            </div>
        </div>
        <div class="input-group">
            <div class="name"></div>
            <div class="value">
                <a href="javascript:void(0);" class="setting_change_password">Change Password</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade pop-up" id="modal-setting_change_name" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background: transparent;">
            <div class="modal-body">
                <div class="container pop-up-container setting-container">
                    <div class="wrap-login100 p-l-30 p-r-30 p-t-30 p-b-30" style="margin:auto;">
                        <form>
                            <span class="login100-form-title p-b-20">
                                Change Name
                            </span>

                            <div class="Metronic-alerts alert alert-success in flash-message" style="display: none"></div>
                            <div class="Metronic-alerts alert alert-danger in flash-message" style="display: none"></div>

                            <div class="wrap-input100 validate-input m-b-15">
                                <input class="input100 name" type="text" name="name" required="true">
                                <span class="focus-input100"></span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade pop-up" id="modal-setting_change_username" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background: transparent;">
            <div class="modal-body">
                <div class="container pop-up-container setting-container">
                    <div class="wrap-login100 p-l-30 p-r-30 p-t-30 p-b-30" style="margin:auto;">
                        <form>
                            <span class="login100-form-title p-b-20">
                                Change Username
                            </span>

                            <div class="Metronic-alerts alert alert-success in flash-message" style="display: none"></div>
                            <div class="Metronic-alerts alert alert-danger in flash-message" style="display: none"></div>

                            <div class="wrap-input100 m-b-15">
                                <input class="input100 name" type="email" name="username" required="true">
                                <span class="focus-input100"></span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Send Me OTP
                                </button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade pop-up" id="modal-setting_change_mobile" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background: transparent;">
            <div class="modal-body">
                <div class="container pop-up-container setting-container">
                    <div class="wrap-login100 p-l-30 p-r-30 p-t-30 p-b-30" style="margin:auto;">
                        <form>
                            <span class="login100-form-title p-b-20">
                                Change Mobile
                            </span>

                            <div class="Metronic-alerts alert alert-success in flash-message" style="display: none"></div>
                            <div class="Metronic-alerts alert alert-danger in flash-message">
                                Service not avaliable
                            </div>

<!--                            <div class="wrap-input100 m-b-15">
                                <input class="input100 mobile_no" type="text" name="mobile_no" required="true">
                                <span class="focus-input100"></span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Send Me OTP
                                </button>
                            </div>-->
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade pop-up" id="modal-setting_change_password" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background: transparent;">
            <div class="modal-body">
                <div class="container pop-up-container change-password-container">
                    <div class="wrap-login100 p-l-30 p-r-30 p-t-30 p-b-30" style="margin:auto;">
                        <form>
                            <span class="login100-form-title p-b-20">
                                Change Password
                            </span>

                            <div class="Metronic-alerts alert alert-success in flash-message" style="display: none"></div>
                            <div class="Metronic-alerts alert alert-danger in flash-message" style="display: none"></div>

                            <div class="wrap-input100 m-b-15">
                                <input class="input100" type="password" name="password" required="true" placeholder="Current Password">
                                <span class="focus-input100"></span>
                            </div>
                            
                            <div class="wrap-input100 m-b-15">
                                <input class="input100" type="password" name="new_password" required="true" placeholder="New Password">
                                <span class="focus-input100"></span>
                            </div>
                            
                            <div class="wrap-input100 m-b-15">
                                <input class="input100" type="password" name="confirm_password" required="true" placeholder="Confirm Password">
                                <span class="focus-input100"></span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Change Password
                                </button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade pop-up" id="modal-otp_confirm" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" style="background: transparent;">
            <div class="modal-body">
                <div class="container pop-up-container setting-container">
                    <div class="wrap-login100 p-l-30 p-r-30 p-t-30 p-b-30" style="margin:auto;">
                        <form>
                            <span class="login100-form-title p-b-20">
                                OTP Confirmation
                            </span>

                            <div class="Metronic-alerts alert alert-success in flash-message" style="display: none"></div>
                            <div class="Metronic-alerts alert alert-danger in flash-message" style="display: none"></div>

                            <div class="wrap-input100 m-b-15">
                                <input class="input100 otp" type="text" required="true">
                                <span class="focus-input100"></span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Verify
                                </button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#modal-setting_change_name form").submit(function()
        {
            var _form = $(this);
            var data = $(this).serializeArray();

            var url = "/Customers/ajaxChangeProfile";
            $.post(url, data, function(response)
            {
                _form.find(".flash-message").hide();

                try
                {
                    response = JSON.parse(response);
                }
                catch (e)
                {
                    $("#error-modal .modal-body").html(response);    $("#error-modal").modal("show");
                    return;
                }

                if (response["status"] == 1)
                {
                    _form.find(".alert-success").html(response["msg"]).show();
                    window.location.reload();
                }
                else
                {
                    _form.find(".alert-danger").html(response["msg"]).show();
                }
            })
            .fail(function(errorObj) 
            {
                Login.onError(url, errorObj);
            });

            return false;
        });

        $("a.setting_change_name").click(function()
        {
            var v = $(this).data("value");
            $("#modal-setting_change_name input.name").val(v);
            $("#modal-setting_change_name").modal("show");
        });

        $("#modal-setting_change_username form").submit(function()
        {
            var _form = $(this);
            var data = $(this).serializeArray();

            var url = "/Customers/ajaxEmailOTP";
            $.post(url, data, function(response)
            {
                _form.find(".flash-message").hide();

                try
                {
                    response = JSON.parse(response);
                }
                catch (e)
                {
                    $("#error-modal .modal-body").html(response);    $("#error-modal").modal("show");
                    return;
                }

                if (response["status"] == 1)
                {
                    $("#modal-setting_change_username").modal("hide");
                    
                    var _modal = $("#modal-otp_confirm");
                    
                    _modal.find(".alert-success").html(response["msg"]).show();

                    _modal.modal("show");

                    _modal.find(".login100-form-btn").unbind("click").click(function(e)
                    {
                        _modal.find(".flash-message").hide();
                        
                        var input_token = _modal.find("input.otp").val();
                        
                        if (response["token"] != input_token)
                        {
                            _modal.find(".alert-danger").html("OTP does not match").show();
                            return false;
                        }

                        var url = "/Customers/ajaxChangeProfile";
                        $.post(url, data, function(response2)
                        {
                            try
                            {
                                response2 = JSON.parse(response2);
                            }
                            catch (e)
                            {
                                $("#error-modal .modal-body").html(response2);    $("#error-modal").modal("show");
                                return;
                            }

                            if (response2["status"] == 1)
                            {
                                _modal.find(".alert-success").html(response2["msg"]).show();
                                window.location.reload();
                            }
                            else
                            {
                                _modal.find(".alert-danger").html(response2["msg"]).show();
                            }
                        })
                        .fail(function(errorObj) 
                        {
                            Login.onError(url, errorObj);
                        });

                        return false;
                    });
                }
                else
                {
                    _form.find(".alert-danger").html(response["msg"]).show();
                }
            })
            .fail(function(errorObj) 
            {
                Login.onError(url, errorObj);
            });

            return false;
        });

        $("a.setting_change_username").click(function()
        {
            $("#modal-setting_change_username").modal("show");
        });
        
        $("#modal-setting_change_mobile form").submit(function()
        {
            var _form = $(this);
            var data = $(this).serializeArray();

            var url = "/Customers/ajaxSMSOTP";
            $.post(url, data, function(response)
            {
                _form.find(".flash-message").hide();

                try
                {
                    response = JSON.parse(response);
                }
                catch (e)
                {
                    $("#error-modal .modal-body").html(response);    $("#error-modal").modal("show");
                    return;
                }

                if (response["status"] == 1)
                {
                    $("#modal-setting_change_username").modal("hide");
                    
                    var _modal = $("#modal-otp_confirm");
                    
                    _modal.find(".alert-success").html(response["msg"]).show();

                    _modal.modal("show");

                    _modal.find(".login100-form-btn").unbind("click").click(function(e)
                    {
                        _modal.find(".flash-message").hide();
                        
                        var input_token = _modal.find("input.otp").val();
                        
                        if (response["token"] != input_token)
                        {
                            _modal.find(".alert-danger").html("OTP does not match").show();
                            return false;
                        }

                        var url = "/Customers/ajaxChangeProfile";
                        $.post(url, data, function(response2)
                        {
                            try
                            {
                                response2 = JSON.parse(response2);
                            }
                            catch (e)
                            {
                                $("#error-modal .modal-body").html(response2);    $("#error-modal").modal("show");
                                return;
                            }

                            if (response2["status"] == 1)
                            {
                                _modal.find(".alert-success").html(response2["msg"]).show();
                                window.location.reload();
                            }
                            else
                            {
                                _modal.find(".alert-danger").html(response2["msg"]).show();
                            }
                        })
                        .fail(function(errorObj) 
                        {
                            Login.onError(url, errorObj);
                        });

                        return false;
                    });
                }
                else
                {
                    _form.find(".alert-danger").html(response["msg"]).show();
                }
            })
            .fail(function(errorObj) 
            {
                Login.onError(url, errorObj);
            });

            return false;
        });

        $("a.setting_change_mobile").click(function()
        {
            $("#modal-setting_change_mobile").modal("show");
        });
        
        $("#modal-setting_change_password form").submit(function()
        {
            var _form = $(this);
            var data = $(this).serializeArray();

            var url = "/Customers/ajaxChangePassword";
            $.post(url, data, function(response)
            {
                _form.find(".flash-message").hide();

                try
                {
                    response = JSON.parse(response);
                }
                catch (e)
                {
                    $("#error-modal .modal-body").html(response);    $("#error-modal").modal("show");
                    return;
                }

                if (response["status"] == 1)
                {
                    _form.find(".alert-success").html(response["msg"]).show();
                }
                else
                {
                    _form.find(".alert-danger").html(response["msg"]).show();
                }
            })
            .fail(function(errorObj) 
            {
                Login.onError(url, errorObj);
            });

            return false;
        });

        $("a.setting_change_password").click(function()
        {
            $("#modal-setting_change_password").modal("show");
        });
    });
</script>