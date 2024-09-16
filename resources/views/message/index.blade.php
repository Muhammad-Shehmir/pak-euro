 @extends('layout.master')

 @section('content')
     <!-- Content -->

     <div class="container-xxl flex-grow-1 container-p-y">
         <div class="d-flex justify-content-between align-items-center p-3 py-0">
             <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a><span class="color">/ Message
             </h4></span>

         </div>


         <!-- Sales This Months -->
         <div class="d-flex justify-content-center p-3 py-0">

             <div class="col-xl-3 col-sm-6">
                 <div class="card">
                     <div class="card-header">
                         <h5 class="mb-0">Available Messages</h5>
                     </div>
                     <div class="card-body">
                         <div class="card-info">
                             <h5 class="mb-0">-357</h5>
                             <p class="text-muted mb-2">Free:234 Paid:-591</p>

                         </div>
                         <div id="saleThisMonth"></div>
                     </div>
                 </div>
             </div>
         </div>


 <div class="pb-1 mb-4">  </div>
         <div class="row mb-5">
             <div class="col-md-6">
                 <div class="card text-center mb-3">
                     <div class="card-header">
                         <ul class="nav nav-tabs" role="tablist">
                             <li class="nav-item">
                                 <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                     data-bs-target="#navs-tab-home" aria-controls="navs-tab-home" aria-selected="true">
                                     Compose
                                 </button>
                             </li>
                             <li class="nav-item">
                                 <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                     data-bs-target="#navs-tab-profile" aria-controls="navs-tab-profile"
                                     aria-selected="false">
                                     Sent
                                 </button>
                             </li>
                             <li class="nav-item">
                                 <button type="button" class="nav-link " data-bs-toggle="tab" role="tab"
                                     aria-selected="false">
                                     Sms Addition
                                 </button>
                             </li>
                         </ul>
                     </div>
                     <div class="card-body">
                         <div class="tab-content p-0">
                             <div class="tab-pane fade show active" id="navs-tab-home" role="tabpanel">
                                 <h5 class="card-title">Special title treatment</h5>
                                 <p class="card-text">
                                     With supporting text below as a natural lead-in to additional content.
                                 </p>
                                 <a href="javascript:void(0);" class="btn btn-primary">Go home</a>
                             </div>
                             <div class="tab-pane fade" id="navs-tab-profile" role="tabpanel">
                                 <h5 class="card-title">Special title treatment</h5>
                                 <p class="card-text">
                                     With supporting text below as a natural lead-in to additional content.
                                 </p>
                                 <a href="javascript:void(0);" class="btn btn-primary">Go profile</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>











         </div>

     </div>
 @endsection
