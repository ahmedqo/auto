<table style="width: 100%; background: #5fbee6">
    <tr>
        <td style="padding: 32px 16px;">
            <div
                style="max-width: 600px;width: 100%;margin: auto;background: #ffffff;border-radius: 8px;overflow: hidden; box-shadow: 0 10px 20px -10px #1d1d1d;">
                <div style="padding: 20px">
                    <a href="{{ route('views.guest.index') }}" aria-label="home_page_link"
                        style="width: 160px; max-width: 100%; display: block; text-decoration: unset; margin: auto;">
                        <img src="{{ asset('img/logo.png') }}?v={{ env('APP_VERSION') }}"
                            style="width: 100%; display: block;margin-bottom: 16px" />
                    </a>
                    <h1
                        style="text-align: center; margin: 0; font-size: 24px; font-weight: 900; margin-bottom: 4px; color: #1d1d1d">
                        {{ __('Your car is reserved at') }} {{ env('COMPANY_NAME') }}
                    </h1>
                    <h2 style="text-align: center; margin: 0; font-size: 16px; font-weight: 600; color: #9f9f9f">
                        {{ strtoupper($data['resreve']->Car->name) }}
                    </h2>
                </div>
                <img src="{{ $data['resreve']->Car->Images[0]->Link }}" alt="{{ $data['resreve']->Car->name }} Image"
                    style="display: block; width: 100%; aspect-ratio: 16/9; object-position: center; object-fit: contain;background: #f9f9f9;" />
                <div style="padding: 20px;">
                    <h2
                        style="text-align: center; margin: 0; font-size: 20px; font-weight: 700; margin-bottom: 4px; color: #1d1d1d">
                        {{ __('Your Receipt') }}
                    </h2>
                    <div style="border: 1px solid #bbbaba; border-radius: 8px;padding: 20px;margin-top: 16px">
                        <table style="width: 100%">
                            <tr>
                                <td style="color:#1d1d1d;font-weight: 500;font-size: 16px;">
                                    {{ __('Per Day') }}
                                </td>
                                <td style="color:#1d1d1d;font-weight: 700;font-size: 18px;text-align: end">
                                    <span>{{ number_format($data['resreve']->Car->price / Core::rate(), 2) }}</span>
                                    <span>{{ Core::$CURRENCY }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="color:#1d1d1d;font-weight: 500;font-size: 16px;">
                                    {{ __('Days Count') }}
                                </td>
                                <td style="color:#1d1d1d;font-weight: 700;font-size: 18px;text-align: end">
                                    <span>{{ $data['resreve']->period }}</span>
                                    <span style="font-size: 14px">{{ __('Days') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr style="border: unset;border-bottom: 1px solid #bbbaba;">
                                </td>
                            </tr>
                            <tr>
                                <td style="color:#1d1d1d;font-weight: 700;font-size: 16px;">
                                    {{ __('Total') }}
                                </td>
                                <td style="color:#1d1d1d;font-weight: 700;font-size: 18px;text-align: end">
                                    <span>{{ number_format($data['resreve']->total / Core::rate(), 2) }}</span>
                                    <span>{{ Core::$CURRENCY }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="padding: 20px; background: #e1e1e1">
                    <table style="width: max-content; max-width: 100%;margin: auto">
                        <tr>
                            <td
                                style="padding: 20px; max-width: 100%; width:max-content; background: #ffffff; border-radius: 8px;">
                                <span
                                    style="foxt-size: 16px; font-weight:600; color: #5fbee6; display: block; margin: auto; width: max-content; max-width: 100%;">
                                    {{ __('Pick-up Date') }}
                                </span>
                                <span
                                    style="text-align: center; margin: auto; font-size: 20px; font-weight: 700; margin-top: 4px; color: #1d1d1d; width: max-content; max-width: 100%;">
                                    {{ Carbon::parse($data['resreve']->from)->format('l F d, h:ia') }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 8px"></td>
                        </tr>
                        <tr>
                            <td
                                style="padding: 20px; max-width: 100%; width:max-content; background: #ffffff; border-radius: 8px;">
                                <span
                                    style="foxt-size: 16px; font-weight:600; color: #5fbee6; display: block; margin: auto; width: max-content; max-width: 100%;">
                                    {{ __('Drop-off Date') }}
                                </span>
                                <span
                                    style="text-align: center; margin: auto; font-size: 20px; font-weight: 700; margin-top: 4px; color: #1d1d1d; width: max-content; max-width: 100%;">
                                    {{ Carbon::parse($data['resreve']->to)->format('l F d, h:ia') }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="padding: 20px;">
                    <h2
                        style="text-align: center; margin: 0; font-size: 20px; font-weight: 700; margin-bottom: 4px; color: #1d1d1d">
                        {{ __('Have a Question?') }}
                    </h2>
                    <table style="width: 100%; margin-top: 16px;">
                        <tr>
                            <td style="padding: 0 8px 0 0">
                                <a href="{{ route('views.guest.faqs') }}"
                                    style="display: block; border: 2px solid #5fbee6; color: #5fbee6; padding: 10px; font-size: 18px; font-weight:700;text-decoration: none; text-align: center; border-radius: 8px;">
                                    {{ __('Go to FAQ') }}
                                </a>
                            </td>
                            <td style="padding: 0 8px">
                                <a href="tel:{{ Core::getSetting('contact_phone') }}"
                                    style="display: block; border: 2px solid #5fbee6; color: #5fbee6; padding: 10px; font-size: 18px; font-weight:700;text-decoration: none; text-align: center; border-radius: 8px;">
                                    {{ __('Give us a call') }}
                                </a>
                            </td>
                            <td style="padding: 0 0 0 8px">
                                <a href="{{ Core::getSetting('contact_phone') }}"
                                    style="display: block; border: 2px solid #5fbee6; color: #5fbee6; padding: 10px; font-size: 18px; font-weight:700;text-decoration: none; text-align: center; border-radius: 8px;">
                                    {{ __('Message us') }}
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
    </tr>
</table>
