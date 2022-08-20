<div class="yay-wrap-menu">
  <div class="yaybar-wrap">
    <ul>
      <li class="yay-label">Single Email Verification</li>
      <li class="@if(isset($active) && $active == 'single')  yay-item-active @endif"><a href="{{ route('single') }}"><span class="yay-icon"><span data-feather="mail" class="rui-icon rui-icon-stroke-1_5"></span></span><span>Single Verification</span><span class="rui-yaybar-circle"></span></a></li>
      <li class="yay-label">Bulk Email Verification</li>
      <li class="@if(isset($active) && $active == 'bulk')  yay-item-active @endif"><a href="{{ route('bulk') }}"><span class="yay-icon"><span data-feather="layers" class="rui-icon rui-icon-stroke-1_5"></span></span><span>Bulk Verification</span><span class="rui-yaybar-circle"></span></a></li>
      <li class="yay-label">API Email Verification</li>
      <li class="@if(isset($active) && $active == 'api')  yay-item-active @endif"><a href="{{ route('api') }}"><span class="yay-icon"><span data-feather="box" class="rui-icon rui-icon-stroke-1_5"></span></span><span>API Verification</span><span class="rui-yaybar-circle"></span></a></li>
      <li class="yay-label">Report Verification</li>
      <li class="@if(isset($active) && $active == 'report')  yay-item-active @endif"><a href="{{ route('report') }}"><span class="yay-icon"><span data-feather="archive" class="rui-icon rui-icon-stroke-1_5"></span></span><span>Report</span><span class="rui-yaybar-circle"></span></a></li>
      <li class="yay-label">Billing</li>
      <li class="@if(isset($active) && $active == 'plan')  yay-item-active @endif"><a href="{{ route('plan') }}"><span class="yay-icon"><span data-feather="pocket" class="rui-icon rui-icon-stroke-1_5"></span></span><span>Plan</span><span class="rui-yaybar-circle"></span></a></li>
      <li class="@if(isset($active) && $active == 'billing')  yay-item-active @endif"><a href="billing_report"><span class="yay-icon"><span data-feather="archive" class="rui-icon rui-icon-stroke-1_5"></span></span><span>Billing Report</span><span class="rui-yaybar-circle"></span></a></li>
    </ul>
  </div>
</div>