@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #2e7d32;
        --primary-light: #4caf50;
        --primary-dark: #1b5e20;
        --secondary: #f9f5e8;
        --accent: #ff9800;
        --light: #f8f9fa;
        --dark: #2d3748;
        --text: #4a5568;
        --border-radius: 12px;
        --shadow: 0 8px 20px rgba(0,0,0,0.08);
        --transition: all 0.3s ease;
        --success: #10b981;
        --error: #ef4444;
    }
    
    body {
        font-family: 'Nunito', sans-serif;
        background: linear-gradient(135deg, #f8f9fa 0%, #e8f5e9 100%);
        color: var(--text);
        line-height: 1.6;
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .form-container {
        max-width: 800px;
        width: 100%;
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        margin: 0 auto;
        animation: fadeIn 0.8s ease;
    }
    
    @keyframes fadeIn {
        from { 
            opacity: 0; 
            transform: translateY(30px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    .form-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 2rem;
        text-align: center;
        color: white;
    }
    
    .form-header h1 {
        font-family: 'Poppins', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .form-header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .form-content {
        padding: 2rem;
    }
    
    .form-group {
        margin-bottom: 1.8rem;
        position: relative;
    }
    
    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark);
        font-size: 1rem;
    }
    
    .form-input {
        width: 100%;
        padding: 0.9rem 1.2rem;
        border: 1px solid #e2e8f0;
        border-radius: var(--border-radius);
        font-size: 1rem;
        transition: var(--transition);
        background: white;
        font-family: 'Nunito', sans-serif;
    }
    
    .form-input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.2);
    }
    
    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    .form-file-container {
        border: 2px dashed #e2e8f0;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        text-align: center;
        transition: var(--transition);
        background: #f8fafc;
    }
    
    .form-file-container:hover {
        border-color: var(--primary);
        background: rgba(46, 125, 50, 0.05);
    }
    
    .form-file-container i {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }
    
    .form-file-container p {
        margin-bottom: 1rem;
        color: var(--text);
    }
    
    .form-file-input {
        display: none;
    }
    
    .form-file-button {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: inline-block;
    }
    
    .form-file-button:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }
    
    .form-file-preview {
        margin-top: 1rem;
        text-align: center;
        flex-direction: column;
        align-items: center;
    }
    
    .form-file-preview img {
        max-width: 200px;
        max-height: 150px;
        border-radius: var(--border-radius);
        border: 1px solid #e2e8f0;
        margin-bottom: 1rem;
    }
    
    .current-image {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem;
        background: #f8fafc;
        border-radius: var(--border-radius);
        margin-bottom: 1rem;
    }
    
    .current-image img {
        max-width: 200px;
        max-height: 150px;
        border-radius: var(--border-radius);
        border: 1px solid #e2e8f0;
        margin-bottom: 0.5rem;
    }
    
    .current-image p {
        color: var(--text);
        font-size: 0.9rem;
        margin: 0;
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
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 1rem 2.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin: 1.5rem auto 0;
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
    }
    
    .form-button:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(46, 125, 50, 0.4);
    }
    
    .form-button:disabled {
        background: #cbd5e0;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }
    
    .form-footer {
        text-align: center;
        padding: 1.5rem;
        color: var(--text);
        font-size: 0.9rem;
        border-top: 1px solid #e2e8f0;
        margin-top: 1rem;
    }
    
    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border-left: 4px solid var(--success);
        padding: 1rem 1.5rem;
        border-radius: var(--border-radius);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    
    .alert-danger {
        background: #fee2e2;
        color: #b91c1c;
        border-left: 4px solid var(--error);
        padding: 1rem 1.5rem;
        border-radius: var(--border-radius);
        margin-bottom: 1.5rem;
    }
    
    .alert-danger ul {
        margin: 0.5rem 0 0 1.5rem;
        padding: 0;
    }
    
    .alert-danger li {
        margin-bottom: 0.3rem;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .form-content {
            padding: 1.5rem;
        }
        
        .form-header {
            padding: 1.5rem;
        }
        
        .form-header h1 {
            font-size: 1.7rem;
        }
        
        body {
            padding: 1rem 0;
        }
    }
    
    @media (max-width: 576px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .form-button {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container-fluid">
    <div class="form-container">
        <div class="form-header">
            <h1>Modifier le produit</h1>
            <p>Mettez à jour les informations de votre produit</p>
        </div>
        
        {{-- Affichage des messages de succès et d'erreur --}}
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
        
        <form id="productForm" class="form-content" action="{{ route('producteur.profil.update', $producteur->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label" for="nom">Nom de l'entreprise</label>
                <input type="text" 
                       id="nom" 
                       name="nom" 
                       class="form-input" 
                       placeholder="Ex: Ferme Bio Nature"
                       value="{{ old('nom', $producteur->nom) }}" 
                       required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea id="description" 
                          name="description" 
                          class="form-input form-textarea" 
                          placeholder="Décrivez votre produit en détail..."
                          required>{{ old('description', $producteur->description) }}</textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="prix">Prix (DT)</label>
                    <input type="number" 
                           step="0.01" 
                           id="prix" 
                           name="prix" 
                           class="form-input" 
                           placeholder="0.00" 
                           min="0"
                           value="{{ old('prix', $producteur->prix) }}" 
                           required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="quantite">Quantité</label>
                    <input type="number" 
                           id="quantite" 
                           name="quantite" 
                           class="form-input" 
                           placeholder="Ex: 20" 
                           min="0"
                           value="{{ old('quantite', $producteur->quantite) }}" 
                           required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="unite">Unité</label>
                    <input type="text" 
                           id="unite" 
                           name="unite" 
                           class="form-input" 
                           placeholder="kg, pièce, litre..."
                           value="{{ old('unite', $producteur->unite) }}" 
                           required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="categorie">Catégorie</label>
                    <select id="categorie" name="categorie" class="form-input" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="fruits" {{ old('categorie', $producteur->categorie) == 'fruits' ? 'selected' : '' }}>Fruits</option>
                        <option value="legumes" {{ old('categorie', $producteur->categorie) == 'legumes' ? 'selected' : '' }}>Légumes</option>
                        <option value="huile_olive" {{ old('categorie', $producteur->categorie) == 'huile_olive' ? 'selected' : '' }}>Huile d'olive</option>
                        <option value="miel" {{ old('categorie', $producteur->categorie) == 'miel' ? 'selected' : '' }}>Miel & Produits de la ruche</option>
                        <option value="produits_laitiers" {{ old('categorie', $producteur->categorie) == 'produits_laitiers' ? 'selected' : '' }}>Produits laitiers</option>
                        <option value="herbes_epices" {{ old('categorie', $producteur->categorie) == 'herbes_epices' ? 'selected' : '' }}>Herbes & Épices</option>
                        <option value="bio" {{ old('categorie', $producteur->categorie) == 'bio' ? 'selected' : '' }}>Produits biologiques</option>
                        <option value="artisanaux" {{ old('categorie', $producteur->categorie) == 'artisanaux' ? 'selected' : '' }}>Produits artisanaux</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Image du produit</label>
                
                {{-- Affichage de l'image actuelle --}}
                @if($producteur->image)
                    <div class="current-image">
                        <img src="{{ asset('storage/' . $producteur->image) }}" alt="Image actuelle">
                        <p>Image actuelle</p>
                    </div>
                @endif
                
                <div class="form-file-container" id="fileContainer">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>{{ $producteur->image ? 'Choisir une nouvelle image (optionnel)' : 'Glissez-déposez votre image ici ou cliquez pour sélectionner' }}</p>
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
</div>

<script>
    // Éléments du DOM
    const productForm = document.getElementById('productForm');
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const fileContainer = document.getElementById('fileContainer');
    const removeImageBtn = document.getElementById('removeImageBtn');
    const submitBtn = document.getElementById('submitBtn');
    
    // Variables globales
    let selectedImage = null;
    
    // Prévisualisation de l'image
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        handleImageSelection(file);
    });
    
    // Animation du bouton de fichier
    document.querySelector('.form-file-button').addEventListener('click', function() {
        imageInput.click();
    });
    
    // Drag and drop pour l'image
    fileContainer.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = 'var(--primary)';
        this.style.backgroundColor = 'rgba(46, 125, 50, 0.1)';
    });
    
    fileContainer.addEventListener('dragleave', function() {
        this.style.borderColor = '#e2e8f0';
        this.style.backgroundColor = '#f8fafc';
    });
    
    fileContainer.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = '#e2e8f0';
        this.style.backgroundColor = '#f8fafc';
        
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            handleImageSelection(file);
            imageInput.files = e.dataTransfer.files;
        }
    });
    
    // Bouton pour supprimer l'image
    removeImageBtn.addEventListener('click', function() {
        previewContainer.style.display = 'none';
        imageInput.value = '';
        selectedImage = null;
    });
    
    // Gestion de la sélection d'image
    function handleImageSelection(file) {
        if (!file) return;
        
        // Validation du type de fichier
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Format d\'image non supporté. Utilisez JPG, PNG ou GIF.');
            return;
        }
        
        // Validation de la taille du fichier (max 2MB)
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
    
    // Animation du bouton de soumission
    submitBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mise à jour...';
        this.disabled = true;
        
        // Réactiver le bouton après 3 secondes en cas d'erreur
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-save"></i> Mettre à jour le produit';
            this.disabled = false;
        }, 3000);
    });
    
    // Animation au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const formContainer = document.querySelector('.form-container');
        formContainer.style.opacity = "0";
        formContainer.style.transform = "translateY(20px)";
        formContainer.style.transition = "opacity 0.5s ease, transform 0.5s ease";
        
        setTimeout(() => {
            formContainer.style.opacity = "1";
            formContainer.style.transform = "translateY(0)";
        }, 100);
    });
</script>

@endsection