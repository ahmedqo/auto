 <div slot="footer" id="footer-content">
     <div>
         <span>{{ __('Ice') }}:</span>
         <span>{{ strtoupper(Core::company()->ice) }}</span>
     </div>
     <div>
         <span>{{ __('License Number') }}:</span>
         <span>{{ strtoupper(Core::company()->license) }}</span>
     </div>
     <div>
         <span>{{ __('Phone') }}:</span>
         <span>{{ Core::company()->phone }}</span>
     </div>
     <div>
         <span>{{ __('Email') }}:</span>
         <span>{{ Core::company()->email }}</span>
     </div>
     <div>
         <span>{{ __('Address') }}:</span>
         <span>
             {{ ucwords(Core::company()->address) }} {{ ucwords(__(Core::company()->city)) }}
             {{ Core::company()->zipcode }}
         </span>
     </div>
 </div>
