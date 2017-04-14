let tags = new Bloodhound({
    prefetch: '/tags.json',
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace
});

$('.tag-input').tagsinput({
    typeaheadjs: [{
        highlight: true,
    }, {
        name: 'tags',
        display: 'name',
        value: 'name',
        source: tags
    }]
});