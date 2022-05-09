
@extends('Layout.app')

@section('content')

<div id="mainDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
	<button id="addNewCourseBtnId" class="btn btn-sm btn-danger my-3">Add New</button>
<table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	   <th class="th-sm">Edit</th>
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

    axios.get('/getProjectData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');

                //$('#course_table').empty(); //signal
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(

                        "<td>"+jsonData[i].project_name+"</td>" +

                        "<td>"+jsonData[i].project_des+"</td>" +

                        

                        "<td> <a data-toggle='modal' data-target='#editModal' class='courseEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +

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
   

   CourseAdd(CourseName, CourseDes);
   location.reload(true);
})


function CourseAdd(project_name, project_des) {

    if(CourseName.length==0){
        toastr.error('CourseName Name is empty !');
    }
    else if(CourseDes.length==0){
        toastr.error('Course Description is empty !');
    }
    
    else{
        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm ' role='status'></div>");
         axios.post('/ProjectAdd', {
            project_name:project_name,
            project_des:project_des
            
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
        //     else{
        //        $('#addCourseModal').modal('hide');
        //       toastr.error('Something Went Wrong.');
          

        // }
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

    axios.post('/ProjectDelete', {
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
    axios.post('/ProjectDetails', {
            id: detailsID
        })
        .then(function(response) {
            if(response.status == 200){

                $('#courseEditForm').removeClass('d-none');
                $('#serviceEditWrong').addClass('d-none');
                var jsonData = response.data;
                $('#CourseNameUpdateId').val(jsonData[0].project_name);
                $('#CourseDesUpdateId').val(jsonData[0].project_des);
                
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
   
   CourseUpdate(courseID, courseName, courseDes) 

})

function CourseUpdate(courseID, courseName, courseDes) {

     if(courseName.length==0){
        toastr.error('courseName is empty !');
    }
    else if(courseDes.length==0){
        toastr.error('courseDes is empty !');
    }
    
    else{
        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm ' role='status'></div>");
         axios.post('/ProjectUpdate', {
            id: courseID,
            project_name:courseName,
            project_des:courseDes,
            
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