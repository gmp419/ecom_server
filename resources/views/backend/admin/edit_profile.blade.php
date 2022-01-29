<div class="col-lg-8">
    <form action="{{route('edit_profile')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5>Edit profile</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" name="name" value="{{$data->name}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" name="email" value="{{$data->email}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Profile Picture</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input class="form-control" type="file" name="profile_photo_path" id="image">
                    </div>
                </div>
                <div class="row mb-3">
                    <img id="showImage" src="{{$data->profile_photo_path ? 
                                            url('upload/adminImages/'.$data->profile_photo_path) : 
                                            url('upload/no_image.jpg')}}" alt="Admin" class="rounded-circle p-1 bg-primary" style="width: 100px; height: 100px;">
                </div>

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                        <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>


<script>
    $(document).ready(function() {
        $('#image').change(function(e) {
            var image = new FileReader();
            image.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            image.readAsDataURL(e.target.files['0']);
        })
    })
</script>