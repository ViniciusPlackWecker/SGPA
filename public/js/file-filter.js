document.addEventListener('DOMContentLoaded', function () {
    function filterFiles() {
        const selectedTags = [...document.querySelectorAll('input[type="checkbox"]:checked')]
            .map(checkbox => checkbox.value);

        document.querySelectorAll('.file-item').forEach(item => {
            const tags = [...item.querySelectorAll('.file-tag')].map(tag => tag.getAttribute('data-tag'));

            // Check if the item contains all the selected tags
            const allTagsMatch = selectedTags.every(tag => tags.includes(tag));

            if (selectedTags.length === 0 || allTagsMatch) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Attach event listeners to filters
    document.querySelectorAll('.tag-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', filterFiles);
    });

    // Initial filter
    filterFiles();
});
