@extends('Layout.app2')
@section('title','Admin Login')
@section('content')

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                                     alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form class="loginForm" action=" ">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">Logo</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                                        <div class="form-outline mb-4">
                                            <input required="" name="userName" id="exampleInputUsername" value="" type="text" id="form2Example17" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example17">User Name</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input required="" name="userPassword" id="exampleInputPassowrd" value="" type="password" id="form2Example27" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button name="submit" class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection



@section('script')
<script type="text/javascript">
        $('.loginForm').on('submit',function (event) {
            event.preventDefault();
            var formData = $(this).serializeArray();
            var userName = formData[0]['value'];
            var password = formData[1]['value'];

            axios.post('/onLogin',{
                'user':userName,
                'pass':password
            }).
            then(function (response){
                if(response.status==200 && response.data==1){
                    window.location.href="/";

                }else{
                    toastr.error('Login Failed. Try Again');
                }

            }).catch(function (){
                    toastr.error('Login Failed. Try Again');
            })
        })




</script>


@endsection
