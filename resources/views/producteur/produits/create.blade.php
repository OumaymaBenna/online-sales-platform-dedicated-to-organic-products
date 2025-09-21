<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit - Ferme Locale</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e8f5e9 100%);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .form-container {
            max-width: 800px;
            width: 100%;
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            margin: 0 auto;
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
            display: none;
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
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
            z-index: 1000;
            transform: translateX(200%);
            transition: transform 0.5s ease;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification.success {
            background: #d1fae5;
            border-left: 4px solid var(--success);
            color: #065f46;
        }
        
        .notification.error {
            background: #fee2e2;
            border-left: 4px solid var(--error);
            color: #b91c1c;
        }
        
        .notification i {
            font-size: 1.5rem;
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
        }
        
        @media (max-width: 576px) {
            body {
                padding: 1rem;
            }
            
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
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>Ajouter un nouveau produit</h1>
            <p>Remplissez les détails de votre produit pour le partager avec la communauté</p>
        </div>
        
        {{-- Affichage des messages de succès et d'erreur --}}
        @if (session('success'))
            <div style="background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; padding: 1rem 1.5rem; border-radius: 12px; margin-bottom: 1.5rem;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; border-left: 4px solid #ef4444; padding: 1rem 1.5rem; border-radius: 12px; margin-bottom: 1.5rem;">
                <i class="fas fa-exclamation-circle"></i> <strong>Erreur(s) :</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form id="productForm" class="form-content" action="{{ route('producteur.produits.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label" for="nom">Nom du produit</label>
                <input type="text" id="nom" name="nom" class="form-input" placeholder="Ex: Tomates bio anciennes" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea id="description" name="description" class="form-input form-textarea" placeholder="Décrivez votre produit en détail..." required></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="prix">Prix (DT)</label>
                    <input type="number" step="0.01" id="prix" name="prix" class="form-input" placeholder="0.00" min="0" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="quantite">Quantité</label>
                    <input type="number id="quantite" name="quantite" class="form-input" placeholder="Ex: 20" min="0" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="unite">Unité</label>
                    <input type="text" id="unite" name="unite" class="form-input" placeholder="kg, pièce, litre..." required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="categorie">Catégorie</label>
                    <select id="categorie" name="categorie" class="form-input" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="fruits">Fruits</option>
                        <option value="legumes">Légumes</option>
                        <option value="huile_olive">Huile d'olive</option>
                        <option value="miel">Miel & Produits de la ruche</option>
                        <option value="produits_laitiers">Produits laitiers</option>
                        <option value="herbes_epices">Herbes & Épices</option>
                        <option value="bio">Produits biologiques</option>
                        <option value="artisanaux">Produits artisanaux</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Image du produit</label>
                <div class="form-file-container" id="fileContainer" onclick="document.getElementById('image').click();">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Glissez-déposez votre image ici ou cliquez pour sélectionner</p>
                    <button type="button" class="form-file-button" onclick="document.getElementById('image').click(); return false;">Choisir un fichier</button>
                    <input type="file" id="image" name="image" class="form-file-input" accept="image/*" required style="display:none;">
                </div>
                <div class="form-file-preview" id="previewContainer" style="display:none;">
                    <img id="previewImage" src="" alt="Aperçu de l'image">
                    <button type="button" class="remove-image-btn" id="removeImageBtn">
                        <i class="fas fa-trash"></i> Supprimer l'image
                    </button>
                </div>
            </div>
            
            <button type="submit" class="form-button" id="submitBtn">
                <i class="fas fa-plus-circle"></i> Ajouter le produit
            </button>
        </form>
        
        <div class="form-footer">
            &copy; 2023 Ferme Locale. Tous droits réservés.
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
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'flex';
                }
                reader.readAsDataURL(this.files[0]);
            }
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
            imageInput.value = '';
            previewImage.src = '';
            previewContainer.style.display = 'none';
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
</body>
</html>