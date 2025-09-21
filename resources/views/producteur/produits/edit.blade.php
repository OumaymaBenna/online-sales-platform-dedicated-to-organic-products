@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #22c55e;
        --primary-dark: #17803a;
        --primary-light: #bbf7d0;
        --background: linear-gradient(135deg, #f6fff8 0%, #e8f5e9 100%);
        --white: #fff;
        --shadow: 0 8px 32px rgba(34, 197, 94, 0.10);
        --border-radius: 18px;
        --transition: all 0.3s cubic-bezier(.4,2,.6,1);
        --text: #222;
        --gray: #e5e7eb;
    }
    body {
        font-family: 'Nunito', 'Poppins', sans-serif;
        background: var(--background);
        color: var(--text);
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }
    .edit-anim-container {
        max-width: 520px;
        margin: 3rem auto;
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        animation: fadeSlideIn 1s cubic-bezier(.4,2,.6,1);
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.7s, transform 0.7s;
    }
    .edit-anim-container.visible {
        opacity: 1;
        transform: translateY(0);
    }
    @keyframes fadeSlideIn {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .form-header {
        background: linear-gradient(90deg, var(--primary) 60%, var(--primary-light) 100%);
        color: var(--white);
        padding: 2rem 1.5rem 1.2rem 1.5rem;
        text-align: center;
        border-top-left-radius: var(--border-radius);
        border-top-right-radius: var(--border-radius);
    }
    .form-header h1 {
        font-family: 'Poppins', sans-serif;
        font-size: 2rem;
        margin-bottom: 0.3rem;
        font-weight: 700;
    }
    .form-header p {
        font-size: 1.1rem;
        opacity: 0.92;
        margin-bottom: 0;
    }
    .form-content {
        padding: 2rem 2rem 1.5rem 2rem;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-label {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.4rem;
        display: block;
    }
    .form-input, .form-input.form-textarea, .form-input:focus {
        width: 100%;
        padding: 0.9rem 1.1rem;
        border: 2px solid var(--primary-light);
        border-radius: 10px;
        font-size: 1rem;
        background: #f6fff8;
        transition: var(--transition);
        font-family: inherit;
        color: var(--text);
        outline: none;
    }
    .form-input:focus {
        border-color: var(--primary);
        background: var(--white);
        box-shadow: 0 0 0 2px var(--primary-light);
    }
    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }
    .form-row {
        display: flex;
        gap: 1.2rem;
        flex-wrap: wrap;
    }
    .form-row .form-group { flex: 1; min-width: 120px; }
    .form-file-container {
        border: 2px dashed var(--gray);
        border-radius: 10px;
        padding: 1.2rem;
        text-align: center;
        background: #f8fafc;
        transition: var(--transition);
        cursor: pointer;
    }
    .form-file-container:hover {
        border-color: var(--primary);
        background: #e8f5e9;
    }
    .form-file-container i {
        font-size: 2.2rem;
        color: var(--primary);
        margin-bottom: 0.7rem;
    }
    .form-file-button {
        background: var(--primary);
        color: var(--white);
        border: none;
        border-radius: 50px;
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        margin-top: 0.7rem;
    }
    .form-file-button:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }
    .form-file-input { display: none; }
    .form-file-preview {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .form-file-preview img {
        max-width: 180px;
        max-height: 120px;
        border-radius: 10px;
        border: 1px solid var(--gray);
        margin-bottom: 0.7rem;
    }
    .current-image {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: #f6fff8;
        border-radius: 10px;
        margin-bottom: 1rem;
        padding: 0.7rem;
    }
    .current-image img {
        max-width: 180px;
        max-height: 120px;
        border-radius: 10px;
        border: 1px solid var(--gray);
        margin-bottom: 0.3rem;
    }
    .remove-image-btn {
        background: rgba(220, 38, 38, 0.1);
        color: #dc2626;
        border: none;
        border-radius: 6px;
        padding: 0.4rem 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .remove-image-btn:hover {
        background: rgba(220, 38, 38, 0.2);
    }
    .form-button {
        background: linear-gradient(90deg, var(--primary) 60%, var(--primary-light) 100%);
        color: var(--white);
        border: none;
        border-radius: 50px;
        padding: 1rem 2.5rem;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        margin: 1.5rem auto 0;
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.13);
        display: flex;
        align-items: center;
        gap: 0.8rem;
        justify-content: center;
    }
    .form-button:hover {
        background: linear-gradient(90deg, var(--primary-dark) 60%, var(--primary) 100%);
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 6px 18px rgba(34, 197, 94, 0.18);
    }
    .form-footer {
        text-align: center;
        padding: 1.2rem;
        color: #6b7280;
        font-size: 0.95rem;
        border-top: 1px solid var(--gray);
        background: #f8fafc;
        border-bottom-left-radius: var(--border-radius);
        border-bottom-right-radius: var(--border-radius);
    }
    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border-left: 4px solid var(--primary);
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    .alert-danger {
        background: #fee2e2;
        color: #b91c1c;
        border-left: 4px solid #ef4444;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    @media (max-width: 600px) {
        .edit-anim-container { max-width: 98vw; margin: 1rem 1vw; }
        .form-content { padding: 1.2rem; }
        .form-header { padding: 1.2rem; }
    }
</style>
<div class="edit-anim-container" id="editAnimContainer">
    <div class="form-header">
        <h1>Modifier le produit</h1>
        <p>Mettez à jour les informations de votre produit</p>
    </div>
    @if (session('success'))
        <div class="form-content" style="padding-bottom: 0;">
            <div class="alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="form-content" style="padding-bottom: 0;">
            <div class="alert-danger">
                <div>
                    <i class="fas fa-exclamation-circle"></i>
                    <strong>Erreur(s) :</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <form id="productForm" class="form-content" action="{{ route('producteur.produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label" for="nom">Nom du produit</label>
            <input type="text" id="nom" name="nom" class="form-input" placeholder="Ex: Tomates bio anciennes" value="{{ old('nom', $produit->nom) }}" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea id="description" name="description" class="form-input form-textarea" placeholder="Décrivez votre produit en détail..." required>{{ old('description', $produit->description) }}</textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label" for="prix">Prix (DT)</label>
                <input type="number" step="0.01" id="prix" name="prix" class="form-input" placeholder="0.00" min="0" value="{{ old('prix', $produit->prix) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="quantite">Quantité</label>
                <input type="number" id="quantite" name="quantite" class="form-input" placeholder="Ex: 20" min="0" value="{{ old('quantite', $produit->quantite) }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label" for="unite">Unité</label>
                <input type="text" id="unite" name="unite" class="form-input" placeholder="kg, pièce, litre..." value="{{ old('unite', $produit->unite) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="categorie">Catégorie</label>
                <select id="categorie" name="categorie" class="form-input" required>
                    <option value="">Sélectionnez une catégorie</option>
                    <option value="fruits" {{ old('categorie', $produit->categorie) == 'fruits' ? 'selected' : '' }}>Fruits</option>
                    <option value="legumes" {{ old('categorie', $produit->categorie) == 'legumes' ? 'selected' : '' }}>Légumes</option>
                    <option value="huile_olive" {{ old('categorie', $produit->categorie) == 'huile_olive' ? 'selected' : '' }}>Huile d'olive</option>
                    <option value="miel" {{ old('categorie', $produit->categorie) == 'miel' ? 'selected' : '' }}>Miel & Produits de la ruche</option>
                    <option value="produits_laitiers" {{ old('categorie', $produit->categorie) == 'produits_laitiers' ? 'selected' : '' }}>Produits laitiers</option>
                    <option value="herbes_epices" {{ old('categorie', $produit->categorie) == 'herbes_epices' ? 'selected' : '' }}>Herbes & Épices</option>
                    <option value="bio" {{ old('categorie', $produit->categorie) == 'bio' ? 'selected' : '' }}>Produits biologiques</option>
                    <option value="artisanaux" {{ old('categorie', $produit->categorie) == 'artisanaux' ? 'selected' : '' }}>Produits artisanaux</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Image du produit</label>
            @if($produit->image)
                <div class="current-image">
                    <img src="{{ asset('storage/' . $produit->image) }}" alt="Image actuelle">
                    <p>Image actuelle</p>
                </div>
            @endif
            <div class="form-file-container" id="fileContainer">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>{{ $produit->image ? 'Choisir une nouvelle image (optionnel)' : 'Glissez-déposez votre image ici ou cliquez pour sélectionner' }}</p>
                <button type="button" class="form-file-button">Choisir un fichier</button>
                <input type="file" id="image" name="image" class="form-file-input" accept="image/*">
            </div>
            <div class="form-file-preview" id="previewContainer" style="display: none;">
                <img id="previewImage" src="" alt="Aperçu de l'image">
                <button type="button" class="remove-image-btn" id="removeImageBtn">
                    <i class="fas fa-trash"></i> Supprimer l'image
                </button>
            </div>
        </div>
        <button type="submit" class="form-button" id="submitBtn">
            <i class="fas fa-save"></i> 
            Mettre à jour le produit
        </button>
    </form>
    <div class="form-footer">
        &copy; 2024 Ferme Locale. Tous droits réservés.
    </div>
</div>
<script>
    // Animation d'apparition du conteneur
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            document.getElementById('editAnimContainer').classList.add('visible');
        }, 100);
    });
    // JS image preview et drag&drop (identique à avant)
    const productForm = document.getElementById('productForm');
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const fileContainer = document.getElementById('fileContainer');
    const removeImageBtn = document.getElementById('removeImageBtn');
    const submitBtn = document.getElementById('submitBtn');
    let selectedImage = null;
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        handleImageSelection(file);
    });
    document.querySelector('.form-file-button').addEventListener('click', function() {
        imageInput.click();
    });
    fileContainer.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = 'var(--primary)';
        this.style.backgroundColor = '#e8f5e9';
    });
    fileContainer.addEventListener('dragleave', function() {
        this.style.borderColor = 'var(--gray)';
        this.style.backgroundColor = '#f8fafc';
    });
    fileContainer.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = 'var(--gray)';
        this.style.backgroundColor = '#f8fafc';
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            handleImageSelection(file);
            imageInput.files = e.dataTransfer.files;
        }
    });
    removeImageBtn.addEventListener('click', function() {
        previewContainer.style.display = 'none';
        imageInput.value = '';
        selectedImage = null;
    });
    function handleImageSelection(file) {
        if (!file) return;
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Format d\'image non supporté. Utilisez JPG, PNG ou GIF.');
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            alert('L\'image est trop volumineuse. Taille max: 2MB');
            return;
        }
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'flex';
            selectedImage = e.target.result;
        }
        reader.readAsDataURL(file);
    }
    submitBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mise à jour...';
    });
</script>
@endsection 