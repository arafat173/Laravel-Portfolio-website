
@extends('Layout.app')

@section('content')

<div id="mainDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
	
<table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Mobile</th>
	  <th class="th-sm">Email</th>
	  <th class="th-sm">Message</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="course_table">
  
	
  </tbody>
</table>

</div>
</div>
</div>



<div id="loaderDivCourse" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">

		<img class="loading-icon" src="{{asset('images/Spinner.svg')}}">

</div>
</div>
</div>

<div id="wrongDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">

		<h3>Something Went Wrong!!!!</h3>

</div>
</div>
</div>






<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
      	<h6 id="courseEditId" class="mt-4 d-none"></h6>
       <div id="courseEditForm" class="container d-none">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
       				<img id="courseEditLoder" class="loading-icon" src="{{asset('images/Spinner.svg')}}">
      				<h3 id="courseEditWrong" class="d-none">Something Went Wrong!!!!</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body text-center p-3">
      	<h5 class="mt-4">Do you want to delete?</h5>
      	<h6 id="CourseDeleteId" class="mt-4 d-none"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
        <button  id="CourseDeleteConfirmBtn" type="button" class="btn btn-sm btn-warning">Yes </button>
      </div>
    </div>
  </div>
</div>
@endsection



@section('script')
<script type="text/javascript">

getCoursesData();

function getCoursesData() {

    axios.get('/getContactData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');

                //$('#course_table').empty(); //signal
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(

                        "<td>"+jsonData[i].contact_name +"</td>" +

                        "<td>"+jsonData[i].contact_mobile +"</td>" +

                        "<td>"+jsonData[i].contact_email+"</td>" +

                        "<td>"+jsonData[i].contact_msg +"</td>" +

                        "<td> <a data-toggle='modal' data-target='#deleteModal' class='courseDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#course_table');
                });

                $('.courseDeleteBtn').click(function(){

                     var id = $(this).data('id');
                     $('#CourseDeleteId').html(id);

                     event.preventDefault();
                     jQuery.noConflict();
                    $('#deleteCourseModal').modal('show');
                })

                 $('.courseEditBtn').click(function(){
                      var id = $(this).data('id');
                       $('#courseEditId').html(id);
                      CourseUpdateDetails(id);
                     event.preventDefault();
                     jQuery.noConflict();
                    $('#updateCourseModal').modal('show');
                })


            } else {

                $('#loaderDivCourse').addClass('d-none');
                $('#wrongDivCourse').removeClass('d-none');
            }


        })
        .catch(function(error) {
            $('#loaderDivCourse').addClass('d-none');
            $('#wrongDivCourse').removeClass('d-none');
        });
}


$('#addNewCourseBtnId').click(function(){
     event.preventDefault();
     jQuery.noConflict();
    $('#addCourseModal').modal('show');
})


$('#CourseAddConfirmBtn').click(function(){
   var CourseName = $('#CourseNameId').val();
   var CourseDes =$('#CourseDesId').val();
   var CourseFee = $('#CourseFeeId').val();
   var CourseEnroll = $('#CourseEnrollId').val();
   var CourseClass = $('#CourseClassId').val();
   var CourseLink = $('#CourseLinkId').val();
   var CourseImg = $('#CourseImgId').val();

   CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg);
   location.reload(true);
})


function CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg) {

    if(CourseName.length==0){
        toastr.error('CourseName Name is empty !');
    }
    else if(CourseDes.length==0){
        toastr.error('Course Description is empty !');
    }
    else if(CourseFee.length==0){
         toastr.error('CourseFee is empty !');
    }
    else if(CourseEnroll.length==0){
         toastr.error('CouCourseEnroll is empty !');
    }
    else if(CourseClass.length==0){
         toastr.error('CourseClass is empty !');
    }
    else if(CourseLink.length==0){
         toastr.error('CourseLink is empty !');
    }
    else if(CourseImg.length==0){
         toastr.error('CourseImg is empty !');
    }
    else{
        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm ' role='status'></div>");
         axios.post('/CoursesAdd', {
            course_name:CourseName,
            course_des:CourseDes,
            course_fee:CourseFee,
            course_totalenroll:CourseEnroll,
            course_totalclass:CourseClass,
            course_link:CourseLink,
            course_img:CourseImg
        })
        .then(function(response) {
             $('#CourseAddConfirmBtn').html("Save");

            if(response.status == 200){
                if (response.data == 1) {

                   $('#addCourseModal').modal('hide');
                toastr.success('Add Success.');
                    getCoursesData();
            } else {
                  $('#addCourseModal').modal('hide');
                toastr.error('Add Fail.');
                   getCoursesData();
            }
        }
            else{
              //  $('#addCourseModal').modal('hide');
              // toastr.error('Something Went Wrong.');
          // 

        }
    })
        .catch(function(error) {
                // $('#addCourseModal').modal('hide');
                // toastr.error('Something Went Wrong.'); 
        });
            }
    }


// Course Delete Confirm
$('#CourseDeleteConfirmBtn').click(function(){
   var id = $('#CourseDeleteId').html();
   CourseDelete(id);
})




// Course Delete
function CourseDelete(deleteID) {
 $('#CourseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm ' role='status'></div>"); // Animation set

    axios.post('/ContactDelete', {
            id: deleteID
        })
        .then(function(response) {
             $('#CourseDeleteConfirmBtn').html("Yes");

            if (response.data == 1) {
                 location.reload(true);
                toastr.success('Delete Success.');
              
            } else {
                location.reload(true);
                toastr.error('Delete Fail.');
               
            }

        })
        .catch(function(error) {

        });
}

function CourseUpdateDetails(detailsID) {
    axios.post('/CoursesDetails', {
            id: detailsID
        })
        .then(function(response) {
            if(response.status == 200){

                $('#courseEditForm').removeClass('d-none');
                $('#serviceEditWrong').addClass('d-none');
                var jsonData = response.data;
                $('#CourseNameUpdateId').val(jsonData[0].course_name);
                $('#CourseDesUpdateId').val(jsonData[0].course_des);
                $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
                $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
                $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
                $('#CourseLinkUpdateId').val(jsonData[0].course_link);
                $('#CourseImgUpdateId').val(jsonData[0].course_img);
            }
            else{
                 $('#courseEditLoder').addClass('d-none');
                 $('#courseEditWrong').removeClass('d-none');
            }
          

        })
        .catch(function(error) {
                 $('#courseEditLoder').addClass('d-none');
                 $('#courseEditWrong').removeClass('d-none');
        });
}



$('#CourseUpdateConfirmBtn').click(function(){
   var courseID=$('#courseEditId').html();
   var courseName=$('#CourseNameUpdateId').val();
   var courseDes=$('#CourseDesUpdateId').val();
   var courseFee=$('#CourseFeeUpdateId').val();
   var courseEnroll=$('#CourseEnrollUpdateId').val();
   var courseClass=$('#CourseClassUpdateId').val();
   var courseLink=$('#CourseLinkUpdateId').val();
   var courseImg=$('#CourseImgUpdateId').val();
   CourseUpdate(courseID, courseName, courseDes,courseFee, courseEnroll, courseClass, courseLink, courseImg) 

})

function CourseUpdate(courseID, courseName, courseDes,courseFee, courseEnroll, courseClass, courseLink, courseImg) {

     if(courseName.length==0){
        toastr.error('courseName is empty !');
    }
    else if(courseDes.length==0){
        toastr.error('courseDes is empty !');
    }
    else if(courseFee.length==0){
         toastr.error('courseFee is empty !');
    }
     else if(courseEnroll.length==0){
        toastr.error('courseEnroll is empty !');
    }
    else if(courseClass.length==0){
         toastr.error('courseClass is empty !');
    }
     else if(courseLink.length==0){
        toastr.error('courseLink is empty !');
    }
    else if(courseImg.length==0){
         toastr.error('courseImg is empty !');
    }
    else{
        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm ' role='status'></div>");
         axios.post('/CoursesUpdate', {
            id: courseID,
            course_name:courseName,
            course_des:courseDes,
            course_fee:courseFee,
            course_totalenroll:courseEnroll,
            course_totalclass:courseClass,
            course_link:courseLink,
            course_img:courseImg
        })
        .then(function(response) {
             $('#CourseUpdateConfirmBtn').html("Save");

            if(response.status == 200){
                if (response.data == 1) {
                    location.reload(true);
                 // $('#editModal').modal('hide');
                toastr.success('Update Success.');
                  // getServicesData();
            } else {
                location.reload(true);
                 // $('#editModal').modal('hide');
                toastr.error('Update Fail.');
                 // getServicesData();
            }
        }
            else{

              //toastr.error('Something Went Wrong.');
          

        }
    })
        .catch(function(error) {
                //toastr.error('Something Went Wrong.'); 
        });
            }
    }


</script>

@endsection