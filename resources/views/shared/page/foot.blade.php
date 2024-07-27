<div slot="footer" id="footer-content">
    <div id="separater">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div id="content">
        <h3>
            <span>{{ __('Ice') }}:</span>
            <span>{{ strtoupper(Core::company()->ice) }}</span>
        </h3>
        <h3>
            <span>{{ __('License Number') }}:</span>
            <span>{{ strtoupper(Core::company()->license) }}</span>
        </h3>
        <h3>
            <span>{{ __('Phone') }}:</span>
            <span>{{ Core::company()->phone }}</span>
        </h3>
        <h3>
            <span>{{ __('Email') }}:</span>
            <span>{{ Core::company()->email }}</span>
        </h3>
        <h3>
            <span>{{ __('Address') }}:</span>
            <span>
                {{ ucwords(Core::company()->address) }} {{ ucwords(__(Core::company()->city)) }}
                {{ Core::company()->zipcode }}
            </span>
        </h3>
    </div>
</div>
