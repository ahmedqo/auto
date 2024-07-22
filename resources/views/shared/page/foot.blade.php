<div slot="footer" id="footer-content">
    <div id="separater">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div id="content">
        <h3>
            {{ url(env('APP_URL'), secure: true) }}
        </h3>
        <h3>
            {{ Core::company()->phone }}
        </h3>
        <h3>
            {{ Core::company()->email }}
        </h3>
    </div>
</div>
