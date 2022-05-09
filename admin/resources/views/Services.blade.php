
@extends('Layout.app')

@section('content')



<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
	<button id="addNewBtnId" class="btn btn-sm btn-danger my-3">Add New</button>
<table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="service_table">
  	

  


  </tbody>
</table>
</div>
</div>
</div>





<div id="loaderDiv" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">

		<img class="loading-icon" src="{{asset('images/Spinner.svg')}}">

</div>
</div>
</div>

<div id="wrongDiv" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">

		<h3>Something Went Wrong!!!!</h3>

</div>
</div>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

       
      <div class="modal-body text-center p-3">
      	<h5 class="mt-4">Do you want to delete?</h5>
      	<h6 id="serviceDeleteId" class="mt-4 d-none"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
        <button  id="serviceDeleteConfirmBtn" type="button" class="btn btn-sm btn-warning">Yes </button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
 <div class="modal-header">
        <h5 class="modal-title">Update Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-5">
					<h6 id="serviceEditId" class="mt-4 d-none"></h6>
					<div id="serviceEditForm" class="w-100 d-none">
      	  <input id="serviceNameID" type="text" id="" class="form-control mb-4" placeholder="Service Name" >
      	  <input id="serviceDesID"  type="text" id="" class="form-control mb-4" placeholder="Service Description" >
      		<input id="serviceImgID" type="text" id="" class="form-control mb-4" placeholder="Service Image Link" >
      		</div>
      				<img id="serviceEditLoder" class="loading-icon" src="{{asset('images/Spinner.svg')}}">
      				<h3 id="serviceEditWrong" class="d-none">Something Went Wrong!!!!</h3>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="serviceEditConfirmBtn" type="button" class="btn btn-sm btn-warning">Save</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="addModal" data-mdb-toggle="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body text-center p-5">
				
					<div id="serviceAddForm" class="w-100 ">
            <h6>Add New Service</h6>
      	  <input id="serviceNameAddID" type="text" id="" class="form-control mb-4" placeholder="Service Name" >
      	  <input id="serviceDesAddID"  type="text" id="" class="form-control mb-4" placeholder="Service Description" >
      		<input id="serviceImgAddID" type="text" id="" class="form-control mb-4" placeholder="Service Image Link" >
      		</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="serviceAddConfirmBtn" type="button" class="btn btn-sm btn-warning">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection


@section('script')


<script type="text/javascript">
	
	getServicesData();

  //For Services Table

function getServicesData() {

    axios.get('/getServicesData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                //$('#service_table').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(

                        "<td><img class='table-img' src=" + jsonData[i].service_img + "> </td>" +
                        "<td>" + jsonData[i].service_name + " </td>" +
                        "<td>" + jsonData[i].service_des + " </td>" +
                        "<td> <a data-toggle='modal' data-target='#editModal' class='serviceEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td> <a data-toggle='modal' data-target='#deleteModal' class='serviceDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#service_table');
                });

                //Service Table Delete Icon Click
                $('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id');

                    $('#serviceDeleteId').html(id);
                })

                //Service Delete Modal Yes Button
                // $('#serviceDeleteConfirmBtn').click(function() {
                //     var id = $('#serviceDeleteId').html();
                //     ServiceDelete(id);
                //     location.reload(true);
                // })

                //Service Table Edit Icon Click
                $('.serviceEditBtn').click(function() {
                   var id = $(this).data('id');
                    $('#serviceEditId').html(id);
                    ServiceUpdateDetails(id);
                 
                })

                // $('#serviceDataTable').DataTable('order':false);
                // $('dataTables_length').addClass('bs-select');
               


                //Service Edit Modal Save Button
                // $('#serviceEditConfirmBtn').click(function() {
                //     var id = $('#serviceEditId').html();
                //     var name = $('#serviceNameID').val();
                //     var des = $('#serviceDesID').val();
                //     var img = $('#serviceImgID').val();

                //     ServiceUpdate(id,name,des,img);
                //     location.reload(true);
                // })


            } else {

                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');
            }


        })
        .catch(function(error) {
            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        });
}

 //Service Delete Modal Yes Button
                $('#serviceDeleteConfirmBtn').click(function() {
                    var id = $('#serviceDeleteId').html();
                    ServiceDelete(id);
                    location.reload(true);
                })

//Service Delete
function ServiceDelete(deleteID) {
 $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm ' role='status'></div>"); // Animation set

    axios.post('/ServiceDelete', {
            id: deleteID
        })
        .then(function(response) {
             $('#serviceDeleteConfirmBtn').html("Yes");

            if (response.data == 1) {

                toastr.success('Delete Success.');
                // getServicesData();
            } else {

                toastr.error('Delete Fail.');
                // getServicesData();
            }

        })
        .catch(function(error) {

        });
}



// Each Service Update Details
function ServiceUpdateDetails(detailsID) {
    axios.post('/ServiceDetails', {
            id: detailsID
        })
        .then(function(response) {
            if(response.status == 200){

                $('#serviceEditForm').removeClass('d-none');
                $('#serviceEditWrong').addClass('d-none');
                var jsonData = response.data;
                $('#serviceNameID').val(jsonData[0].service_name);
                $('#serviceDesID').val(jsonData[0].service_des);
                $('#serviceImgID').val(jsonData[0].service_img);
            }
            else{
                 $('#serviceEditLoder').addClass('d-none');
                 $('#serviceEditWrong').removeClass('d-none');
            }
          

        })
        .catch(function(error) {
                 $('#serviceEditLoder').addClass('d-none');
                 $('#serviceEditWrong').removeClass('d-none');
        });
}


//Service Edit Modal Save Button
                $('#serviceEditConfirmBtn').click(function() {
                    var id = $('#serviceEditId').html();
                    var name = $('#serviceNameID').val();
                    var des = $('#serviceDesID').val();
                    var img = $('#serviceImgID').val();

                    ServiceUpdate(id,name,des,img);
                    location.reload(true);
                })



function ServiceUpdate(serviceID, serviceName, serviceDes, serviceImg) {

     if(serviceName.length==0){
        toastr.error('Service Name is empty !');
    }
    else if(serviceDes.length==0){
        toastr.error('Service Description is empty !');
    }
    else if(serviceImg.length==0){
         toastr.error('Service Image is empty !');
    }
    else{
        $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm ' role='status'></div>");
         axios.post('/ServiceUpdate', {
            id: serviceID,
            name:serviceName,
            des:serviceDes,
            img:serviceImg,
        })
        .then(function(response) {
             $('#serviceEditConfirmBtn').html("Save");

            if(response.status == 200){
                if (response.data == 1) {

                 // $('#editModal').modal('hide');
                toastr.success('Update Success.');
                  // getServicesData();
            } else {
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



//Service Add New Btn CLick


$('#addNewBtnId').click(function(event){
     event.preventDefault();
    jQuery.noConflict();
        $('#addModal').modal('show');
   
    
})




//Service Edit Modal Save Button
                $('#serviceAddConfirmBtn').click(function() {                 
                    var name = $('#serviceNameAddID').val();
                    var des = $('#serviceDesAddID').val();
                    var img = $('#serviceImgAddID').val();

                    ServiceAdd(name,des,img);
                    location.reload(true);
                })


//Service Add method

function ServiceAdd(serviceName, serviceDes, serviceImg) {

     if(serviceName.length==0){
        toastr.error('Service Name is empty !');
    }
    else if(serviceDes.length==0){
        toastr.error('Service Description is empty !');
    }
    else if(serviceImg.length==0){
         toastr.error('Service Image is empty !');
    }
    else{
        $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm ' role='status'></div>");
         axios.post('/ServiceAdd', {
            name:serviceName,
            des:serviceDes,
            img:serviceImg,
        })
        .then(function(response) {
             $('#serviceAddConfirmBtn').html("Save");

            if(response.status == 200){
                if (response.data == 1) {

                   $('#addModal').modal('hide');
                toastr.success('Add Success.');
                    getServicesData();
            } else {
                  $('#addModal').modal('hide');
                toastr.error('Add Fail.');
                    getServicesData();
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