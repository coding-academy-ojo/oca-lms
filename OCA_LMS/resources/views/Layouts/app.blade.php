
{{-- ========================= Start Top Section ========================== --}}
@include('layouts.top')
{{-- ========================= End Top Section ========================== --}}



{{-- ============================= Start Header =========================== --}}
@include('layouts.header')
{{-- ============================= End Header ============================= --}}



{{-- ============================= Start Content ========================== --}}
@yield('content')
{{-- ============================= End Content ============================ --}}



{{-- ============================= Start Footer =========================== --}}
@include('layouts.footer')
{{-- ============================= End Footer ============================= --}}



{{-- ======================= Start Bottom Section ========================= --}}
@include('layouts.bottom')
{{-- ========================= End Bottom Section ========================= --}}
