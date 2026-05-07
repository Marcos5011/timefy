<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <title>TIMEFY</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <style>
        :root {
            --bg-site: #0b0e14;
            --bg-card: #1a1c23;
            --verde-neon: #00ff88;
            --cinza: #818181;
            --borda: #2a2d37;
        }

        body {
            background: linear-gradient(135deg, #0f0f0f, #1b1b1b);
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .home {
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .home-container {
            width: 100%;
            max-width: 620px;
        }

        .header-content {
            margin-bottom: 40px;
            text-align: center;
        }

        .header-content h1 {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
        }

        .header-content h1 span {
            color: var(--verde-neon);
        }

        .header-content p {
            color: var(--cinza);
            font-size: 15px;
            margin-top: 5px;
        }

        .details-box {
            background: #2a2a2a;
            padding: 40px;
            border-radius: 24px;
            border: 1px solid var(--borda);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: white;
        }

        input {
            width: 100%;
            padding: 16px;
            background: #3a3a3a;
            border: 1.5px solid var(--borda);
            border-radius: 12px;
            color: #fff;
            box-sizing: border-box;
            transition: 0.3s;
        }

        input:focus {
            border-color: var(--verde-neon);
            outline: none;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .btn-criar {
            flex: 1;
            padding: 16px;
            background: var(--verde-neon);
            color: #000;
            border: none;
            border-radius: 12px;
            font-weight: 800;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-cancelar {
            flex: 1.125;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ff4d4d;
            color: #fff;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-criar:hover,
        .btn-cancelar:hover {
            filter: brightness(1.1);
            transform: scale(1.02);
        }

        @media (max-width: 480px) {
            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <section class="home">
        <div class="home-container">
            <div class="header-content">
                <h1>Novo <span>Usuário</span></h1>
                <p>Cadastre-se para acessar a plataforma.</p>
            </div>
            <div class="details-box">
                <form action="cadastro_config.php" method="POST">
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Nome</label>
                            <input type="text" name="nome" placeholder="Digite seu nome" required>
                        </div>
                        <div class="input-group">
                            <label>E-mail</label>
                            <input type="email" name="email" placeholder="Digite seu e-mail" required>
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="input-group">
                            <label>CPF</label>
                            <input type="text" name="cpf" placeholder="000.000.000-00" required>
                        </div>
                        <div class="input-group">
                            <label>Telefone</label>
                            <input type="tel" name="telefone" placeholder="(11) 98765-4321">
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Data de Nascimento</label>
                            <input type="date" name="data_nascimento">
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Senha</label>
                            <input type="password" name="senha" placeholder="Digite sua senha" required>
                        </div>
                        <div class="input-group">
                            <label>Confirmação de Senha</label>
                            <input type="password" name="confirmar_senha" placeholder="Digite novamente sua senha" required>
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn-criar">Criar Conta</button>
                        <a href="../login/login.php" class="btn-cancelar">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        const formCadastro = document.querySelector('form');

        formCadastro.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(formCadastro);

            try {
                const response = await fetch('./cadastro_config.php', {
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
                    window.location.href = "../login/login.php";
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