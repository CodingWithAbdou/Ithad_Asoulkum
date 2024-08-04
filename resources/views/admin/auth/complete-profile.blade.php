@extends('admin.layouts.auth')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <h1 class="text-center mb-5">Complete Your Profile</h1>
                    <form method="POST" action="{{ route('dashboard.profile.complete.submit') }}" class="w-100">
                        @csrf


                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Phone Number</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="phone_number" required />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Job Title</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="job_title"
                                required />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Company or Office</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="company"
                                required />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">ID Number</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="id_number"
                                required />
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Complete Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
