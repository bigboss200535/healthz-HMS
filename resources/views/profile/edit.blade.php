<x-app-layout>
<div class="container-xxl flex-grow-1 container-p-y">    
          <div class="app-ecommerce">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1 mt-3">Update User Password</h4>
          <p class="text-muted">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-3">
          <!-- <button class="btn btn-primary">E-Claims</button> -->
          <!-- <a href="#" class="btn btn-primary"><i class="menu-icon tf-icons bx bx-refresh"></i> Generate Claim IT </a> -->
        </div>
      </div>
  <div class="row">
   <div class="col-12 col-lg-8">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-tile mb-0"><b>Password Infomation</b></h5>
        </div>
        <div class="card-body">
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
          @csrf
          @method('put')

          <div class="row mb-3">
            <div class="col">
              <label class="form-label" for="old_password">Old Password <a style="color: red;">*</a></label>
              <input type="password" class="form-control" id="old_password" name="old_password">
            </div>
            <div class="col">
              <label class="form-label" for="new_password">New Password <a style="color: red;">*</a></label>
              <input type="password" class="form-control" id="new_password" name="new_password">
              </select>
            </div>
            <!-- <div>
                   <x-input-label class="form-label" for="password_confirmation" :value="__('Confirm Password')" />
                   <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                   <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div> 
              -->
            <div class="col">
              <label class="form-label" for="report_type">Confirm Password <a style="color: red;">*</a></label>
             <input type="password" class="form-control" id="confirm_password" name="comfirm_password">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card mb-4">
        <div class="card-body">
            <img src="{{ asset('img/undraw/login.svg') }}" alt="" height="120px">
            <br>
        </div>
      </div>
    </div>
    <!-- <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div> -->
    <div class="d-flex align-content-center flex-wrap gap-3">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </form>
  </div>
</div>
</div>        
</x-app-layout>