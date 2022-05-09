<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My users') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one m-5">PHP Laravel Project - Comment</h1>

                <table class="table mt-3  text-left">
                    <thead>
                        <tr>

                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{!! $user->name !!}</td>
                                <td>{!! $user->email !!}</td>
                                @if ($user->status == 1)
                                    <td class="text-success">{!! 'Activé' !!}</td>
                                @else
                                    <td class="text-danger">{!! 'Désactivé' !!}</td>
                                @endif

                                    @if ($user->status != 1)
                                    <td>

                                        <button type="button" class="btn btn-outline-success ml-1"
                                        onClick='showEnableModel({!! $user->id !!})'>Enable</button>
                                    </td>
                                   @else

                                    <td>
                                        <button type="button" class="btn btn-outline-danger ml-1"
                                        onClick='showModel({!! $user->id !!})'>Disable</button>
                                    </td>

                                    @endif

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="disableConfirmationModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">Are you sure to disable this user account?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onClick="dismissModel()">Cancel</button>
                    <form id="disable-frm" class="" action="" method="POST">
                        @method('GET')
                        @csrf
                        <button class="btn btn-danger">Disable</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="enableConfirmationModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">Are you sure to enable this user account?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onClick="dismissEnableModel()">Cancel</button>
                    <form id="enable-frm" class="" action="" method="POST">
                        @method('GET')
                        @csrf
                        <button class="btn btn-danger">Enable</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showModel(id) {
            var frmDelete = document.getElementById("disable-frm");
            frmDelete.action = 'changestatus/' + id;
            var confirmationModal = document.getElementById("disableConfirmationModel");
            confirmationModal.style.display = 'block';
            confirmationModal.classList.remove('fade');
            confirmationModal.classList.add('show');
        }

        function showEnableModel(id) {
            var frmDelete = document.getElementById("enable-frm");
            frmDelete.action = 'changestatus/' + id;
            var confirmationModal = document.getElementById("enableConfirmationModel");
            confirmationModal.style.display = 'block';
            confirmationModal.classList.remove('fade');
            confirmationModal.classList.add('show');
        }

        function dismissModel() {
            var confirmationModal = document.getElementById("disableConfirmationModel");
            confirmationModal.style.display = 'none';
            confirmationModal.classList.remove('show');
            confirmationModal.classList.add('fade');
        }

        function dismissEnableModel() {
            var confirmationModal = document.getElementById("enableConfirmationModel");
            confirmationModal.style.display = 'none';
            confirmationModal.classList.remove('show');
            confirmationModal.classList.add('fade');
        }
    </script>
</x-app-layout>
