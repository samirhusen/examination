@component('mail::message')
    <table style="width: 100%; background-color: #f7f7f7; padding: 20px;">
        <tr>
            <td align="center">
                <h2 style="font-size: 24px; color: #333; margin-bottom: 20px;">Questionnaire Invitation</h2>
                <p style="font-size: 16px; color: #555; margin-bottom: 20px;">
                    You have been invited to participate in a questionnaire. Click on the button below to access the
                    questionnaire:
                </p>
            </td>
        </tr>
        <tr>
            <td align="center">
                <a href="{{ $url }}"
                    style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; font-size: 18px;">
                    Access Questionnaire
                </a>
            </td>
        </tr>
        <tr>
            <td align="center">
                <p style="font-size: 14px; color: #888; margin-top: 20px;">
                    Thanks,<br>
                    {{ config('app.name') }}
                </p>
            </td>
        </tr>
    </table>
@endcomponent
