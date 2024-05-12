function gcd(a, b) {
    if (b === 0) {
        return a;
    } else {
        return gcd(b, a % b);
    }
}

// Hàm kiểm tra tính nguyên tố của số n
function isPrime(n) {
    if (n <= 1) {
        return false;
    }
    for (let i = 2; i <= Math.sqrt(n); i++) {
        if (n % i === 0) {
            return false;
        }
    }
    return true;
}

// Hàm tạo khóa công khai và khóa bí mật
// Hàm tạo khóa công khai và khóa bí mật
function generateKeyPair(p, q) {
    if (!isPrime(p) || !isPrime(q)) {
        throw new Error('p và q phải là số nguyên tố');
    } else if (p === q) {
        throw new Error('p và q không được giống nhau');
    }

    const n = p * q;
    const phi = (p - 1) * (q - 1);

    let e = 2;
    while (e < phi) {
        if (gcd(e, phi) === 1) {
            break;
        } else {
            e++;
        }
    }

    let d = 0;
    let k = 1;
    while (true) {
        d = (1 + k * phi) / e;
        if (Number.isInteger(d)) {
            break;
        } else {
            k++;
        }
    }

    const publicKey = { e, n };
    const privateKey = { d, n };

    return {
        publicKey,
        privateKey
    };
}

// Hàm mã hóa thông điệp
function encrypt_v(message, publicKey) {
    const { e, n } = publicKey;
    let encryptedMessage = '';

    for (let i = 0; i < message.length; i++) {
        const charCode = message.charCodeAt(i);
        const encryptedCharCode = BigInt(charCode) ** BigInt(e) % BigInt(n);
        encryptedMessage += encryptedCharCode.toString() + ' ';
    }

    return encryptedMessage.trim();
}

function encrypt(message, publicKey) {
    const { e, n } = publicKey;
    let encryptedMessage = '';

    // Convert message to hex string
    const hexMessage = encodeURIComponent(message).replace(/%([0-9A-F]{2})/g, (_, p1) => {
        return String.fromCharCode(parseInt(p1, 16));
    }).split('').map(c => c.charCodeAt(0).toString(16).padStart(2, '0')).join('');

    // Encrypt hex string
    for (let i = 0; i < hexMessage.length; i += 2) {
        const hexCode = hexMessage.substr(i, 2);
        const bigHexCode = BigInt(`0x${hexCode}`);
        const encryptedCharCode = bigHexCode ** BigInt(e) % BigInt(n);
        encryptedMessage += encryptedCharCode.toString() + ' ';
    }
    return encryptedMessage.trim();
}

// Hàm giải mã thông điệp
function decrypt(encryptedMessage, privateKey) {
    const { d, n } = privateKey;
    let decryptedMessage = '';

    const encryptedCharCodes = encryptedMessage.split(' ');
    for (let i = 0; i < encryptedCharCodes.length; i++) {
        const encryptedCharCode = BigInt(encryptedCharCodes[i]);
        const decryptedCharCode = encryptedCharCode ** BigInt(d) % BigInt(n);
        decryptedMessage += String.fromCharCode(Number(decryptedCharCode));
    }

    return decryptedMessage;
}





