@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if(Session::has('mess'))
            <div id="successMessage" class="alert alert-success">
              {{ Session::get('mess')}}
            </div>
            @endif

            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>National id/Passport Id</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i= 1;
                    @endphp
                    @foreach($rows as $value)

                    <tr id="datarow{{ $value->id }}">
                        <td>{{ $i }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->country }}</td>
                        <td>{{ $value->phone }}</td>
                        <td>{{ $value->money }}</td>
                        <td>{{ $value->national_or_passport }}</td>
                        <td>

                            <a href="{{ route('user.edit',['user' => $value->id]) }}" class="btn btn-success">Edit</a>
                             <a href="javascript:void(0)"  onclick="info({{ $value }})" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info">View</a>
                            {{-- <a href="{{ route('user.show',['user' => $value->id]) }}" class="btn btn-info">View</a> --}}


                            <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteFun({{ $value->id }})">Delete</a>

                         {{-- <form id="delete-form{{ $value->id }}" action="{{ route('user.destroy',['user' => $value->id]) }}" method="DELETE" class="d-none">
                             @csrf
                         </form> --}}


                        </td>

                    </tr>

                    @php
                    $i++;
                @endphp
                    @endforeach

                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>National id/Passport Id</th>
                        <th>Action</th>
                    </tr>
                </tfoot> --}}
            </table>



        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">




      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
      </div>
    </div>
  </div>
</div>
<script>



    function info(item) {
// console.log(item)
        var modalBodyInput = exampleModal.querySelector('.modal-body')



        var html = `
        <div class="col-md-4"><b>Name</b>:${item.name}</div>
        <div class="col-md-4"><b>Phone Number</b>:${item.phone}</div>
        <div class="col-md-4"><b>Email</b>:${item.email}</div>
        <div class="col-md-4"><b>Username</b>:${item.username}</div>
        <div class="col-md-4"><b>Country</b>:${item.country}</div>
        <div class="col-md-4"><b>City/State</b>:${item.city}</div>
        <div class="col-md-4"><b>Nationality</b>:${item.nationality}</div>
        <div class="col-md-4"><b>Money</b>:${item.money}</div>
        <div class="col-md-4"><b>National id/Passport Id</b>:${item.national_or_passport}</div>




        `;

        modalBodyInput.innerHTML = html




    }


function deleteFun(id) {


    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {

    var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const headers = {
        'X-CSRF-TOKEN':laravelToken
    }
    const data ={}
    axios.delete('/home/user/'+id,data,headers)
    .then((response)=> {
        console.log(response);
        if(response.status==200){
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }

        $("#datarow"+id).remove();

    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });




  }
})








    // axios.post('/home/user/'+id, form, { headers: 'X-CSRF-TOKEN':laravelToken })
}












    setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 3000); // <-- time in milliseconds
</script>

@endsection
