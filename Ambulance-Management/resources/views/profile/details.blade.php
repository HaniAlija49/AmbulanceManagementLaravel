<x-app-layout>

    <div class="container mt-4">
        <h2 class="mb-4">User Details</h2>

        <div class="card">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Id</dt>
                    <dd class="col-sm-9">{{ $user->id }}</dd>

                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $user->name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>

                    <dt class="col-sm-3">Number</dt>
                    <dd class="col-sm-9">{{ $user->number }}</dd>

                    <dt class="col-sm-3">Date of Birth</dt>
                    <dd class="col-sm-9">{{ $user->date_of_birth}}</dd>

                    <dt class="col-sm-3">Gender</dt>
                    <dd class="col-sm-9">{{ $user->gender }}</dd>

                    <dt class="col-sm-3">Education</dt>
                    <dd class="col-sm-9">{{ $user->education }}</dd>

                    <dt class="col-sm-3">Type</dt>
                    <dd class="col-sm-9">{{ $user->type }}</dd>

                    <dt class="col-sm-3">Biography</dt>
                    <dd class="col-sm-9">{{ $user->biography }}</dd>

                    <dt class="col-sm-3">Profile Picture</dt>
                    <dd class="col-sm-9">
                        @if ($user->profilePictureData != null)
                            <img src="data:{{ $user->profilePictureContentType }};base64,{{ base64_encode($user->profilePictureData) }}" alt="Profile Picture" class="img-thumbnail" />
                        @else
                            <p>No profile picture available.</p>
                        @endif
                    </dd>
                </dl>
            </div>
        </div>

        <div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-rounded"><i class="fa fa-arrow-left"></i> Back to List</a>
        </div>
    </div>

</x-app-layout>