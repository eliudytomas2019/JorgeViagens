<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        text-align: center;
    }

    .error-code {
        font-size: 6rem;
        font-weight: bold;
        color: #f93b00;
    }

    .error-message {
        font-size: 1.5rem;
        color: #1d1d1b;
    }

    .go-home {
        margin-top: 20px;
    }

    .go-home a {
        text-decoration: none;
        color: #050435;
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="error-code">404</div>
    <div class="error-message">Página não encontrada</div>
    <div class="go-home"><a href="<?= HOME; ?>">Voltar para a página inicial</a></div>
</div>