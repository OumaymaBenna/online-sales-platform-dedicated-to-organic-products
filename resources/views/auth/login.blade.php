<x-guest-layout>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap');

    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
      overflow-x: hidden;
    }

    .background-overlay {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      pointer-events: none;
      background: url('https://www.transparenttextures.com/patterns/organic-paper.png') repeat;
      opacity: 0.1;
      z-index: 0;
      animation: bgShift 60s linear infinite;
    }

    @keyframes bgShift {
      from {background-position: 0 0;}
      to {background-position: 1000px 0;}
    }

    .container {
      position: relative;
      max-width: 420px;
      margin: 4rem auto;
      padding: 3rem 3rem;
      background: rgba(255 255 255 / 0.15);
      border-radius: 2rem;
      box-shadow:
        0 8px 32px 0 rgba(31, 38, 135, 0.1),
        inset 0 0 0 1px rgba(255 255 255 / 0.25);
      backdrop-filter: blur(15px);
      -webkit-backdrop-filter: blur(15px);
      border: 1px solid rgba(255 255 255 / 0.18);
      z-index: 10;
      animation: fadeInSlideUp 0.9s ease forwards;
    }

    @keyframes fadeInSlideUp {
      0% {
        opacity: 0;
        transform: translateY(30px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Header */
    .header {
      text-align: center;
      margin-bottom: 3rem;
      color: #064e3b;
      user-select: none;
    }
    .header img {
      width: 96px;
      height: 96px;
      margin: 0 auto 1rem;
      filter: drop-shadow(0 3px 6px rgba(5, 150, 105, 0.7));
      transition: transform 0.4s ease;
    }
    .header img:hover {
      transform: scale(1.12) rotate(10deg);
    }
    .header h2 {
      font-size: 2.75rem;
      font-weight: 900;
      letter-spacing: 0.12em;
      margin: 0;
      text-shadow: 0 0 10px #047857aa;
    }
    .header p {
      margin-top: 0.5rem;
      font-weight: 600;
      font-size: 1rem;
      color: #065f46dd;
      letter-spacing: 0.06em;
    }

    /* Form group & floating labels */
    .form-group {
      position: relative;
      margin-bottom: 2.4rem;
      animation: fadeInSlideUp 0.7s ease forwards;
    }
    .form-group:nth-child(2) { animation-delay: 0.3s; }
    .form-group:nth-child(3) { animation-delay: 0.4s; }

    input[type="email"], input[type="password"] {
      width: 100%;
      background: rgba(255 255 255 / 0.2);
      border-radius: 1rem;
      border: 1.8px solid rgba(255 255 255 / 0.3);
      padding: 1.2rem 1.6rem 0.4rem 1.6rem;
      font-size: 1.05rem;
      font-weight: 600;
      color: #064e3b;
      box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.07);
      outline: none;
      transition:
        border-color 0.35s ease,
        background-color 0.35s ease,
        box-shadow 0.35s ease;
    }
    input::placeholder {
      color: transparent;
    }
    input:focus {
      border-color: #22c55e;
      background: rgba(255 255 255 / 0.3);
      box-shadow:
        0 0 12px 2px #22c55eaa,
        inset 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    label {
      position: absolute;
      top: 1.25rem;
      left: 1.6rem;
      color: #d1fae5;
      font-weight: 700;
      pointer-events: none;
      user-select: none;
      font-size: 1rem;
      transition: all 0.35s ease;
      text-shadow: 0 0 4px rgba(34, 197, 94, 0.9);
      background: linear-gradient(45deg, #22c55e, #15803d);
      padding: 0 0.45rem;
      border-radius: 0.6rem;
    }

    input:focus + label,
    input:not(:placeholder-shown) + label {
      top: -0.65rem;
      left: 1.25rem;
      font-size: 0.75rem;
      color: #d1fae5;
      text-shadow:
        0 0 10px #22c55e,
        0 0 18px #15803d;
      font-weight: 900;
      letter-spacing: 0.08em;
    }

    /* Checkbox and remember me */
    .remember-me {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: #064e3b;
      font-weight: 600;
      font-size: 0.9rem;
      user-select: none;
    }
    .remember-me input[type="checkbox"] {
      width: 1.2rem;
      height: 1.2rem;
      border-radius: 0.3rem;
      border: 1.5px solid #a3a3a3;
      accent-color: #22c55e;
      cursor: pointer;
      box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    /* Button */
    button[type="submit"] {
      width: 100%;
      background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
      border-radius: 9999px;
      border: none;
      font-weight: 900;
      font-size: 1.25rem;
      padding: 1.15rem;
      color: #e0f2fe;
      cursor: pointer;
      box-shadow:
        0 0 12px #22c55e,
        0 8px 16px #15803d;
      transition: all 0.35s ease;
      letter-spacing: 0.1em;
      text-shadow: 0 0 4px #b7f5c6;
      user-select: none;
      animation: pulseGlow 3s infinite;
    }
    button[type="submit"]:hover {
      background: linear-gradient(135deg, #15803d 0%, #22c55e 100%);
      box-shadow:
        0 0 18px #22c55e,
        0 12px 20px #15803d;
      transform: scale(1.08);
    }
    button[type="submit"]:active {
      transform: scale(0.97);
      box-shadow:
        0 0 8px #22c55e,
        0 6px 12px #15803d;
    }

    @keyframes pulseGlow {
      0%, 100% {
        box-shadow:
          0 0 12px #22c55e,
          0 8px 16px #15803d;
      }
      50% {
        box-shadow:
          0 0 22px #22c55e,
          0 12px 28px #15803d;
      }
    }

    /* Messages */
    .alert-success {
      background: rgba(134, 239, 172, 0.3);
      border-left: 6px solid #22c55e;
      color: #064e3b;
      font-weight: 700;
      padding: 1rem 1.25rem;
      border-radius: 0.75rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 0 8px #22c55e66;
      user-select: none;
    }
    .alert-error {
      background: rgba(254, 202, 202, 0.3);
      border-left: 6px solid #dc2626;
      color: #991b1b;
      font-weight: 700;
      padding: 1rem 1.25rem;
      border-radius: 0.75rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 0 8px #dc262666;
      user-select: none;
    }

    /* Link */
    a.text-link {
      font-weight: 600;
      color: #064e3b;
      text-decoration: none;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      user-select: none;
    }
    a.text-link:hover {
      color: #22c55e;
      text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 500px) {
      .container {
        margin: 2rem 1rem;
        padding: 2.5rem 2rem;
        max-width: 100%;
        border-radius: 1.5rem;
      }
      .header h2 {
        font-size: 2rem;
      }
      button[type="submit"] {
        font-size: 1.1rem;
        padding: 1rem;
      }
    }
  </style>

  <div class="background-overlay"></div>

  <main class="container" role="main" aria-label="Formulaire de connexion">
    <header class="header">
      <img src="https://img.icons8.com/color/96/vegetarian-food.png" alt="Logo Produits Locaux" />
      <h2>Connexion</h2>
      <p>Bienvenue dans votre marché local 🌿</p>
    </header>

    @if(session('success'))
      <div class="alert-success" role="alert">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert-error" role="alert">{{ session('error') }}</div>
    @endif

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" novalidate>
      @csrf

      <div class="form-group">
        <input id="email" type="email" name="email" placeholder=" " value="{{ old('email') }}" required autofocus autocomplete="username" />
        <label for="email">Adresse email</label>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <div class="form-group">
        <input id="password" type="password" name="password" placeholder=" " required autocomplete="current-password" />
        <label for="password">Mot de passe</label>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <div class="form-group remember-me">
        <input id="remember_me" type="checkbox" name="remember" />
        <label for="remember_me">Se souvenir de moi</label>
      </div>

      <div style="display:flex; justify-content:center; margin-top:2.4rem;">
        <button type="submit">Se connecter</button>
      </div>

      <div class="text-center mt-6">
        <a href="{{ route('register') }}" class="text-link">
          Pas encore inscrit ? <span class="underline">Créer un compte</span>
        </a>
      </div>
    </form>
  </main>
</x-guest-layout>
