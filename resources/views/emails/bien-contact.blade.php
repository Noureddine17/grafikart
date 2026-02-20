
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Nouveau message de contact</title>
</head>

<body style="margin:0;padding:0;background:#f4f4f4;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#f4f4f4;">
    <tr>
        <td align="center" style="padding:30px 15px;">

            <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0"
                   style="width:600px;max-width:600px;background:#ffffff;border-radius:10px;overflow:hidden;font-family:Arial,Helvetica,sans-serif;">

                <!-- Header -->
                <tr>
                    <td style="padding:20px 25px;background:#111;color:#ffffff;">
                        <h2 style="margin:0;font-size:20px;">Nouveau message de contact</h2>
                    </td>
                </tr>

                <!-- Bien -->
                <tr>
                    <td style="padding:20px 25px;">
                        <h3 style="margin:0 0 15px 0;font-size:16px;color:#111;">Informations du bien</h3>

                        <p style="margin:6px 0;font-size:14px;">
                            <strong>Bien :</strong> {{ $payload['bien_title'] }} (ID {{ $payload['bien_id'] }})
                        </p>

                        <p style="margin:6px 0;font-size:14px;">
                            <strong>Prix :</strong>
                            {{ number_format($payload['bien_prix'], 0, ',', ' ') }} EUR
                        </p>

                        <p style="margin:6px 0;font-size:14px;">
                            <strong>Lien :</strong>
                            <a href="{{ $payload['bien_url'] }}"
                               style="color:#1a73e8;text-decoration:none;">
                                Voir le bien
                            </a>
                        </p>
                    </td>
                </tr>

                <!-- Separator -->
                <tr>
                    <td style="padding:0 25px;">
                        <hr style="border:none;border-top:1px solid #e5e5e5;">
                    </td>
                </tr>

                <!-- Contact -->
                <tr>
                    <td style="padding:20px 25px;">
                        <h3 style="margin:0 0 15px 0;font-size:16px;color:#111;">Informations du visiteur</h3>

                        <p style="margin:6px 0;font-size:14px;">
                            <strong>Prénom :</strong> {{ $payload['prenom'] }}
                        </p>

                        <p style="margin:6px 0;font-size:14px;">
                            <strong>Nom :</strong> {{ $payload['name'] }}
                        </p>

                        <p style="margin:6px 0;font-size:14px;">
                            <strong>Email :</strong>
                            <a href="mailto:{{ $payload['email'] }}"
                               style="color:#1a73e8;text-decoration:none;">
                                {{ $payload['email'] }}
                            </a>
                        </p>

                        <p style="margin:6px 0;font-size:14px;">
                            <strong>Téléphone :</strong> {{ $payload['tel'] }}
                        </p>
                    </td>
                </tr>

                <!-- Message -->
                <tr>
                    <td style="padding:0 25px 25px 25px;">
                        <h3 style="margin:0 0 10px 0;font-size:16px;color:#111;">Message</h3>

                        <div style="padding:15px;background:#f9f9f9;border-radius:6px;font-size:14px;line-height:1.6;color:#333;">
                            {{ $payload['msg'] }}
                        </div>
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>
</body>
</html>
