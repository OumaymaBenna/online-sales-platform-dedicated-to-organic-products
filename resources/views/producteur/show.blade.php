<form action="{{ route('avis.store', $produit) }}" method="POST">
    @csrf
    <label>Note (1 à 5) :</label>
    <select name="note" required>
        @for ($i=1; $i<=5; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    <br>
    <label>Commentaire :</label>
    <textarea name="commentaire"></textarea>
    <br>
    <button type="submit">Envoyer</button>
</form>
