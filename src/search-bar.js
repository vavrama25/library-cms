document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('input[placeholder="Hledat knihu, autora"]');
    const suggestionsList = document.getElementById('suggestions-list');
    
    let libraryData = [];

    if (suggestionsList && searchInput) {
        const parentDiv = searchInput.parentElement;
        if (parentDiv) parentDiv.style.position = 'relative';
        
        suggestionsList.style.position = 'absolute';
        suggestionsList.style.top = '100%';
        suggestionsList.style.left = '0';
        suggestionsList.style.right = '0';
        suggestionsList.style.zIndex = '1000';
        suggestionsList.style.backgroundColor = '#ffffff';
        suggestionsList.style.listStyle = 'none';
        suggestionsList.style.padding = '0';
        suggestionsList.style.margin = '4px 0 0 0';
        suggestionsList.style.border = '1px solid #dee2e6';
        suggestionsList.style.borderRadius = '0.375rem';
        suggestionsList.style.boxShadow = '0 0.5rem 1rem rgba(0, 0, 0, 0.15)';
        suggestionsList.style.maxHeight = '250px';
        suggestionsList.style.overflowY = 'auto';
        suggestionsList.style.display = 'none';
    }

    async function loadData() {
        try {
            const response = await fetch('src/search-data.json');
            if (!response.ok) throw new Error('Soubor src/search-data.json nebyl nalezen (HTTP Status: ' + response.status + ')');
            
            libraryData = await response.json();
            
            // KONTROLA V KONZOLI (F12)
            console.log('Načtená data z src/search-data.json:', libraryData);

        } catch (error) {
            console.error('Chyba při načítání vyhledávání:', error);
        }
    }

    loadData();

    if (searchInput && suggestionsList) {
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.trim().toLowerCase();

            if (query.length === 0) {
                suggestionsList.innerHTML = '';
                suggestionsList.style.display = 'none';
                return;
            }

            // Flexibilní filtrování
            const matches = libraryData.filter(item => {
                const title = String(item.title || item.Title || item.nazev || '').toLowerCase();
                const autor = String(item.autor || item.Autor || item.author || '').toLowerCase();

                return title.includes(query) || autor.includes(query);
            });

            renderResults(matches);
        });

        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !suggestionsList.contains(e.target)) {
                suggestionsList.style.display = 'none';
            }
        });
    }

    function renderResults(results) {
        suggestionsList.innerHTML = '';

        if (results.length === 0) {
            const li = document.createElement('li');
            li.style.padding = '10px 15px';
            li.style.color = '#6c757d';
            li.style.fontSize = '14px';
            li.textContent = 'Žádná shoda';
            suggestionsList.appendChild(li);
            suggestionsList.style.display = 'block';
            return;
        }

        results.forEach(book => {
            const li = document.createElement('li');
            li.style.borderBottom = '1px solid #f1f5f9';
            li.style.cursor = 'pointer';

            // Získání ID
            const id = book["ID_cms-content"] || book.id || book.ID || 0;
            const title = book.title || book.Title || book.nazev || 'Bez názvu';
            const autor = book.autor || book.Autor || book.author || 'Neznámý autor';

            const a = document.createElement('a');
            

            a.href = `detail?id=${id}`;
            
            a.style.display = 'block';
            a.style.padding = '10px 15px';
            a.style.textDecoration = 'none';
            a.style.color = '#212529';

            a.addEventListener('mouseenter', () => a.style.backgroundColor = '#f8f9fa');
            a.addEventListener('mouseleave', () => a.style.backgroundColor = 'transparent');

            a.innerHTML = `
                <div style="font-weight: 600; font-size: 14px;">${escapeHtml(title)}</div>
                <div style="font-size: 12px; color: #6c757d;">${escapeHtml(autor)}</div>
            `;

            li.appendChild(a);
            suggestionsList.appendChild(li);
        });

        suggestionsList.style.display = 'block';
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }
});