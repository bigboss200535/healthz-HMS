
<!-- 
 R1 -  Developer
 R2 - System Administrator
 R3 - IT Officer
 R4 - Claims Officer
 R5 - HOSPITAL ADMINISTRATOR
 R6 - HOSPITAL MANAGER
 R7 - ACCOUNTS OFFICER
R8 - ACCOUNTANT
R9 - NURSE
R10 - DOCTOR ASSISTANT
R11 - 
R12

  
  -->
<aside x-data="{ open: false }" id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo ">
    <a href="#" class="app-brand-link">
      <!-- <span class="app-brand-logo demo">
      <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
          <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
          <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3"></path>
          <path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4"></path>
          <path d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z" id="path-5"></path>
        </defs>
        <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
            <g id="Icon" transform="translate(27.000000, 15.000000)">
              <g id="Mask" transform="translate(0.000000, 8.000000)">
                <mask id="mask-2" fill="white">
                  <use xlink:href="#path-1"></use>
                </mask>
                <use fill="#696cff" xlink:href="#path-1"></use>
                <g id="Path-3" mask="url(#mask-2)">
                  <use fill="#696cff" xlink:href="#path-3"></use>
                  <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                </g>
                <g id="Path-4" mask="url(#mask-2)">
                  <use fill="#696cff" xlink:href="#path-4"></use>
                  <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                </g>
              </g>
              <g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                <use fill="#696cff" xlink:href="#path-5"></use>
                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
              </g>
            </g>
          </g>
        </g>
      </svg>
    </span> -->
      <span class="app-brand-text demo menu-text fw-bold ms-2">{{ config('app.name') }}</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>
  <!--------------------------Home------------------------------------>
  <div class="menu-inner-shadow"></div>
  <ul class="menu-inner py-1">
    <li class="menu-item">
      <a href="{{ url('/dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div class="text-truncate" data-i18n="Dashboards">Home</div>
      </a>
    </li>
    <!----------------------------Menu--------------------------------->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="Apps & Pages">Apps</span>
    </li>
    @if(Auth::user()->role_id == 'R1')
    <!-- -----------------------------------patient------------------->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div class="text-truncate" data-i18n="Users">Patient</div>
         <!-- <span class="badge badge-center rounded-pill bg-success ms-auto">4</span> -->
      </a>
      <ul class="menu-sub">
      <!-- <li class="menu-item">
          <a href="{{ route('patients.create') }}" class="menu-link">
            <div class="text-truncate" data-i18n="List">Add </div>
          </a>
        </li> -->
         <li class="menu-item">
          <a href="{{ route('patients.index') }}" class="menu-link">
            <div class="text-truncate" data-i18n="List">Search</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('patients.index') }}" class="menu-link">
            <div class="text-truncate" data-i18n="List">Sponsors</div>
          </a>
        </li>
      </ul>
    </li>
    @endif
  <!-----------nurses------------------------>
  @if(Auth::user()->role_id == 'R1' ||Auth::user()->role_id == 'R2')
  <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-injection"></i>
        <div class="text-truncate" data-i18n="Users">Nurses</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Vital Signs</div>
          </a>
        </li>
         <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Notes</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">24 Hour Report</div>
          </a>
        </li>
        <li class="menu-item">
         <a href="#" class="menu-link">
          <div class="text-truncate" data-i18n="list">Medications</div>
         </a>
        </li>
      </ul>
    </li>
    @endif
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-hotel"></i>
        <div class="text-truncate" data-i18n="Users">In-Patient</div>
         <!-- <span class="badge badge-center rounded-pill bg-success ms-auto">4</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Consultations</div>
          </a>
        </li>
         <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Surgery</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Discharges</div>
          </a>
        </li>
        <li class="menu-item">
         <a href="#" class="menu-link">
          <div class="text-truncate" data-i18n="list">Medications</div>
         </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-male-female"></i>
        <div class="text-truncate" data-i18n="Users">Out-Patient</div>
         <!-- <span class="badge badge-center rounded-pill bg-success ms-auto">4</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('consultation/opd-consultation') }}" class="menu-link">
            <div class="text-truncate" data-i18n="List">Consultations</div>
          </a>
        </li>
         <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Surgery</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Discharges</div>
          </a>
        </li>
        <!-- <li class="menu-item">
         <a href="#" class="menu-link">
          <div class="text-truncate" data-i18n="list">Medications</div>
         </a>
        </li> -->
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-vial"></i>
        <div class="text-truncate" data-i18n="Users">Investigations</div>
         <!-- <span class="badge badge-center rounded-pill bg-success ms-auto">4</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Laboratory</div>
          </a>
        </li>
         <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Imaging</div>
          </a>
        </li>
        <!-- <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Discharges</div>
          </a>
        </li> -->
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-credit-card-alt"></i>
        <div class="text-truncate" data-i18n="Users">Revenue</div>
         <!-- <span class="badge badge-center rounded-pill bg-success ms-auto">4</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Patient Bill</div>
          </a>
        </li>
         <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Invoices</div>
          </a>
        </li>
        <!-- <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Discharges</div>
          </a>
        </li> -->
        <!-- <li class="menu-item">
         <a href="#" class="menu-link">
          <div class="text-truncate" data-i18n="list">Medications</div>
         </a>
        </li> -->
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-band-aid"></i>
        <div class="text-truncate" data-i18n="Users">Stores / Pharmacy</div>
         <!-- <span class="badge badge-center rounded-pill bg-success ms-auto">4</span> -->
      </a>
      <ul class="menu-sub">
        <!-- <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Item Setup</div>
          </a>
        </li> -->
         <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Dispensing</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Return Medication</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Return Medication</div>
          </a>
        </li>
        <!-- <li class="menu-item">
         <a href="#" class="menu-link">
          <div class="text-truncate" data-i18n="list">Medications</div>
         </a>
        </li> -->
      </ul>
    </li>
 
<!-- ---------------------------------------sett--------------------------------------------- -->
<!-- -----------------------------------leads------------------------------------------------- -->
<li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-credit-card"></i>
        <div class="text-truncate" data-i18n="Users">Claims</div>
         <!-- <span class="badge badge-center rounded-pill bg-success ms-auto">4</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/claims/nhis-management') }}" class="menu-link">
            <div class="text-truncate" data-i18n="List">NHIS</div>
          </a>
        </li>
         <li class="menu-item">
          <a href="{{ url('/claims/private-management') }}" class="menu-link">
            <div class="text-truncate" data-i18n="List">Private</div>
          </a>
        </li>
        
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Cash</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Co-operate</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-envelope"></i>
        <div class="text-truncate" data-i18n="Users">Notifications</div>
         <!-- <span class="badge badge-center rounded-pill bg-success ms-auto">4</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="List">Sms</div>
          </a>
        </li>
      </ul>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('notifications/all')}}" class="menu-link">
            <div class="text-truncate" data-i18n="List">Notifications</div>
          </a>
        </li>
      </ul>
    </li>
<!-- --------------------------------------/-salaries--------------------------------------------- -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text" data-i18n="Components">System Setup</span></li>
    <!-- Cards -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div class="text-truncate" data-i18n="Cards">Users</div>
        <!-- <span class="badge badge-center rounded-pill bg-danger ms-auto">6</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/users') }}" class="menu-link">
            <div class="text-truncate" data-i18n="Basic">Manage Users</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Roles & Permissions</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div class="text-truncate" data-i18n="Cards">Items / Prices</div>
        <!-- <span class="badge badge-center rounded-pill bg-danger ms-auto">6</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/products') }}" class="menu-link">
            <div class="text-truncate" data-i18n="Basic">Item Setup</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div class="text-truncate" data-i18n="Cards">Service Setup</div>
        <!-- <span class="badge badge-center rounded-pill bg-danger ms-auto">6</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/services') }}" class="menu-link">
            <div class="text-truncate" data-i18n="Basic">Services Fee</div>
          </a>
        </li>
      </ul>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Basic">Fees</div>
          </a>
        </li>
      </ul>
    </li>
<!-- --------------------------------------/-tax--------------------------------------------- -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div class="text-truncate" data-i18n="Cards">Payables</div>
        <!-- <span class="badge badge-center rounded-pill bg-danger ms-auto">6</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Basic">PAYE</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">SSNIT</div>
          </a>
        </li>
      </ul>
    </li>
<!-- --------------------------------------/-tax--------------------------------------------- -->
<li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div class="text-truncate" data-i18n="Cards">Diagnosis</div>
        <!-- <span class="badge badge-center rounded-pill bg-danger ms-auto">6</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/diagnosis')}}" class="menu-link">
            <div class="text-truncate" data-i18n="Basic">Diagnosis setup</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Complains</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">NHIA Services</div>
          </a>
        </li>
      </ul>
    </li>
   
<!-- ---------------------------------------------------------------------------- -->
<li class="menu-header small text-uppercase"><span class="menu-header-text" data-i18n="Components">Reports</span></li>
<li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
        <div class="text-truncate" data-i18n="Cards">Administration</div>
        <!-- <span class="badge badge-center rounded-pill bg-danger ms-auto">6</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/reports/users') }}" class="menu-link">
            <div class="text-truncate" data-i18n="Basic">Users</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">User Logs</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">User Logs</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div class="text-truncate" data-i18n="Cards">OPD Records</div>
        <!-- <span class="badge badge-center rounded-pill bg-danger ms-auto">6</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="/reports/users_list" class="menu-link">
            <div class="text-truncate" data-i18n="Basic">Patient Registration</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Daily Attendance</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Consulting Register</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Surgeries</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Morbidity/Mortality</div>
          </a>
        </li>

      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div class="text-truncate" data-i18n="Cards">Admissions</div>
        <!-- <span class="badge badge-center rounded-pill bg-danger ms-auto">6</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/reports/users') }}" class="menu-link">
            <div class="text-truncate" data-i18n="Basic">Ward State</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Admissions</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Discharges</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Ward Transfer</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Birth</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Death</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div class="text-truncate" data-i18n="Cards">Consultations</div>
        <!-- <span class="badge badge-center rounded-pill bg-danger ms-auto">6</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/consultation/opd-consultation') }}" class="menu-link">
            <div class="text-truncate" data-i18n="Basic">Consultations</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Electronic Folder</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Disease</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div class="text-truncate" data-i18n="Cards">Dispensary</div>
        <!-- <span class="badge badge-center rounded-pill bg-danger ms-auto">6</span> -->
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/reports/users') }}" class="menu-link">
            <div class="text-truncate" data-i18n="Basic">Tally Cards</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Item Bulletin</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Prescriptions</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Dispensed</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Pending Prescription</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div class="text-truncate" data-i18n="Advance">Returned Prescription</div>
          </a>
        </li>
      </ul>
    </li>

  </ul>
</aside>