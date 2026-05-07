<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <title>TIMEFY</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #0f0f0f, #1b1b1b);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 10%;
            color: white;
        }

        .left {
            max-width: 600px;
        }

        .left h1 {
            font-size: 40px;
            color: #38f28e;
            margin-bottom: 40px;
            line-height: 1.3;
        }

        .left img {
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            width: 400px;
            background: #2a2a2a;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        }

        .login-card h2 {
            text-align: center;
            color: #38f28e;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #3a3a3a;
            color: white;
            outline: none;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #38f28e;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2de07f;
        }

        .forgot {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #ccc;
            cursor: pointer;
            text-decoration: none;
        }

        .forgot:hover {
            color: #38f28e;
        }

        .erro {
            background: #ff4d4d;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="left">
        <h1>Acesse o TIMEFY e tenha o controle total direto do seu navegador!</h1>
        <img src="../image/image.svg" alt="Ilustração">
    </div>

    <div class="login-card">
        <h2>LOGIN</h2>

        <form method="POST">
            <div class="form-group">
                <label>Usuário</label>
                <input type="text" name="usuario" placeholder="Usuário" required>
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" placeholder="Senha" required>
            </div>

            <button type="submit">LOGIN</button>
        </form>

        <div class="forgot"><a href="../cadastro/cadastro.php" class="forgot">Criar Conta</a></div>
        <div class="forgot"><a href="../recuperar/recupera.php" class="forgot">Esqueceu a senha?</a></div>
    </div>


    <script>
        const formLogin = document.querySelector('form');

        formLogin.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(formLogin);

            try {
                const response = await fetch('./login_config.php', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`Erro HTTP! Status: ${response.status}`);
                }

                const textoBruto = await response.text();
                console.log("Resposta bruta do PHP:", textoBruto);

                const dados = JSON.parse(textoBruto);

                if (dados.success) {
                    window.location.href = "../dashboard/index.php";
                } else {
                    alert(dados.message);
                }
            } catch (error) {
                console.error("Erro detalhado:", error);
                alert("Erro detectado: " + error.message);
            }
        });
    </script>
</body>

</html>