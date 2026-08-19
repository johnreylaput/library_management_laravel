<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Periodical Index - UC Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .section-selection-active {
            overflow: hidden;
        }

        #sectionOverlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 9998;
        }

        .header-branding {
            padding: 20px 0;
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
        }

        .header-branding img {
            max-height: 60px;
        }

        .title-banner {
            background: linear-gradient(135deg, #1a5276 0%, #2980b9 100%);
            padding: 30px 0;
            margin: 20px 0;
            position: relative;
            overflow: hidden;
        }

        .title-banner::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 40px;
            background: #f5f5f5;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }

        .title-banner h1 {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 300;
            margin: 0;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        .search-section {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .search-section .form-select,
        .search-section .form-control {
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            padding: 10px 15px;
        }

        .search-section .btn-primary {
            background-color: #2980b9;
            border-color: #2980b9;
            padding: 10px 30px;
            font-weight: 500;
        }

        .search-section .btn-primary:hover {
            background-color: #1a5276;
            border-color: #1a5276;
        }

        .results-header {
            padding: 15px 0;
            border-bottom: 2px solid #27ae60;
            margin-bottom: 20px;
        }

        .results-header h3 {
            color: #333;
            font-weight: 600;
            margin: 0;
        }

        .result-item {
            background-color: #fff;
            border-left: 4px solid #27ae60;
            padding: 20px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.2s ease;
            border-radius: 4px;
        }

        .result-item:hover {
            background-color: #f9f9f9;
            transform: translateX(5px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .result-item .doc-icon {
            font-size: 2.5rem;
            color: #2980b9;
            margin-right: 20px;
        }

        .result-item .result-title {
            color: #2980b9;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .result-item .result-meta {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .result-item .result-meta strong {
            color: #444;
            font-weight: 600;
        }

        .no-results {
            background-color: #fff;
            padding: 40px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .no-results i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .detail-modal .modal-content {
            border-radius: 8px;
            border: none;
        }

        .detail-modal .modal-header {
            background-color: #1a5276;
            color: #fff;
            border-radius: 8px 8px 0 0;
        }

        .detail-modal .modal-body {
            padding: 30px;
        }

        .detail-modal .detail-section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .detail-modal .detail-section:last-child {
            border-bottom: none;
        }

        .detail-modal .detail-label {
            font-weight: 600;
            color: #1a5276;
            margin-bottom: 5px;
        }

        .detail-modal .detail-value {
            color: #333;
            line-height: 1.6;
        }

        .detail-modal .abstract-box {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            border-left: 4px solid #2980b9;
            line-height: 1.8;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #2980b9;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            padding: 8px 0;
        }

        .back-link:hover {
            color: #1a5276;
        }

        .campus-banner {
            background-color: #000;
            color: #fff;
            padding: 12px 0;
            text-align: left;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .campus-banner .campus-banner-text {
            text-align: left;
        }

        .banner-index-title {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        @media (max-width: 768px) {
            .title-banner h1 {
                font-size: 1.8rem;
            }

            .banner-index-title {
                font-size: 1.3rem;
            }

            .search-section .row {
                gap: 10px;
            }

            .result-item {
                padding: 15px;
            }

            .result-item .doc-icon {
                font-size: 2rem;
                margin-right: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="header-branding">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('UCB.png') }}" alt="UC Banilad Campus Logo" class="me-3" style="max-height: 60px;">
                        <img src="{{ asset('images/uc-library-logo.png') }}" alt="UC Library Logo" class="me-3" style="max-height: 50px;">
                       
                    </div>
                    <div class="text-center">
                        <span class="fw-bold text-primary banner-index-title">IN-HOUSE-PERIODICAL INDEX</span>
                    </div>
                    <div class="d-flex gap-2">
                        @if(Auth::check() && Auth::user()->role === 'Member')
                            <a href="{{ route('search.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Back to Browse Resources
                            </a>
                        @endif
                        @if(Auth::check() && in_array(Auth::user()->role, ['Admin', 'Librarian', 'Working-Student']))
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-gear"></i> Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('e-periodical.index', ['view' => 'add-journal']) }}">
                                            <i class="bi bi-plus-circle"></i> Add Journal Article
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('e-periodical.index', ['view' => 'all-journals']) }}">
                                            <i class="bi bi-journal-arrow-down"></i> View Journal Article
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('e-periodical.index', ['view' => 'edit-journal']) }}">
                                            <i class="bi bi-pencil"></i> Edit Journal Article
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('e-periodical.index', ['view' => 'delete-journal']) }}">
                                            <i class="bi bi-trash"></i> Delete Journal Article
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('journals.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Back to Journals Dashboard
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="campus-banner">
            <div class="container">
                <div class="campus-banner-text text-start">University of Cebu Banilad</div>
            </div>
        </div>

        <div class="title-banner">
            <div class="container position-relative">
                <h1 class="banner-title">E-Periodical Index</h1>
            </div>
        </div>

        <div class="container">
            <div class="search-section">
                <form action="{{ route('e-periodical.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <select name="type" class="form-select">
                                <option value="all" {{ ($type ?? 'all') == 'all' ? 'selected' : '' }}>All Types</option>
                                <option value="journals" {{ ($type ?? '') == 'journals' ? 'selected' : '' }}>Journals</option>
                                <option value="theses" {{ ($type ?? '') == 'theses' ? 'selected' : '' }}>Theses</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="search_field" class="form-select" aria-label="Search field selector">
                                <option value="all" {{ ($searchField ?? 'all') == 'all' ? 'selected' : '' }}>All Fields</option>
                                <option value="title" {{ ($searchField ?? '') == 'title' ? 'selected' : '' }}>Title</option>
                                <option value="authors" {{ ($searchField ?? '') == 'authors' ? 'selected' : '' }}>Author</option>
                                <option value="journal_name" {{ ($searchField ?? '') == 'journal_name' ? 'selected' : '' }}>Journal Name</option>
                                <option value="keyword" {{ ($searchField ?? '') == 'keyword' ? 'selected' : '' }}>Keyword</option>
                                <option value="subjects" {{ ($searchField ?? '') == 'subjects' ? 'selected' : '' }}>Subject</option>
                                <option value="doi" {{ ($searchField ?? '') == 'doi' ? 'selected' : '' }}>DOI / ISSN</option>
                                <option value="isbn" {{ ($searchField ?? '') == 'isbn' ? 'selected' : '' }}>ISBN</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="q" class="form-control" placeholder="Search by title, author, journal name, subject, keyword, DOI, ISSN..." value="{{ $query ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @if($view === 'add-journal')
                <div class="alert alert-info">
                    <h5><i class="bi bi-plus-circle"></i> Add Journal Article</h5>
                    <p>Click the button below to add a new journal article.</p>
                    <a href="{{ route('journals.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add New Journal Article
                    </a>
                </div>
            @endif

            @if($view === 'all-journals' && $allJournals->count() > 0)
                <div class="results-header">
                    <h3>All Journal Articles ({{ $allJournals->count() }})</h3>
                </div>
                @foreach($allJournals as $journal)
                    <div class="result-item" data-type="journal" data-id="{{ $journal->id }}" onclick="showJournalDetail({{ $journal->id }})">
                        <div class="d-flex align-items-start">
                            <div class="doc-icon">
                                <i class="bi bi-journal-arrow-down"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="result-meta">
                                    <strong>Author of the Article:</strong> {{ $journal->authors ?? 'N/A' }}
                                </div>
                                <div class="result-meta">
                                    <strong>Title of the Article:</strong> {{ $journal->title }}
                                </div>
                                @if(!empty($journal->source))
                                    <div class="result-meta">
                                        <strong>Source:</strong> "{{ $journal->source }}"
                                    </div>
                                @endif
                                <div class="result-meta">
                                    <strong>Title of the Journal:</strong> {{ $journal->journal_name ?? 'N/A' }}
                                </div>
                                <div class="result-meta">
                                    <strong>Abstract:</strong> "{{ \Illuminate\Support\Str::limit($journal->abstract, 250) ?: 'No abstract available.' }}"
                                </div>
                                <div class="result-meta">
                                    <strong>Subject:</strong> {{ $journal->subjects ?? ($journal->category_text ?? 'N/A') }}
                                </div>
                                @if(!empty($journal->keyword))
                                    <div class="result-meta">
                                        <strong>Keyword:</strong> {{ $journal->keyword }}
                                    </div>
                                @endif
                                <div class="result-meta">
                                    <strong>Note:</strong> {{ \Illuminate\Support\Str::limit($journal->description, 250) ?: 'No additional note available.' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            @if($view === 'edit-journal' && $allJournals->count() > 0)
                <div class="results-header">
                    <h3>Select a Journal Article to Edit ({{ $allJournals->count() }})</h3>
                </div>
                @foreach($allJournals as $journal)
                    <div class="result-item" data-type="journal" data-id="{{ $journal->id }}">
                        <div class="d-flex align-items-start">
                            <div class="doc-icon">
                                <i class="bi bi-journal-arrow-down"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="result-meta">
                                    <strong>Author of the Article:</strong> {{ $journal->authors ?? 'N/A' }}
                                </div>
                                <div class="result-meta">
                                    <strong>Title of the Article:</strong> {{ $journal->title }}
                                </div>
                                <div class="result-meta">
                                    <strong>Title of the Journal:</strong> {{ $journal->journal_name ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="ms-3">
                                <a href="{{ route('journals.edit', $journal->id) }}" class="btn btn-warning btn-sm" onclick="event.stopPropagation();">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            @if($view === 'delete-journal' && $allJournals->count() > 0)
                <div class="results-header">
                    <h3>Select a Journal Article to Delete ({{ $allJournals->count() }})</h3>
                </div>
                @foreach($allJournals as $journal)
                    <div class="result-item" data-type="journal" data-id="{{ $journal->id }}">
                        <div class="d-flex align-items-start">
                            <div class="doc-icon">
                                <i class="bi bi-journal-arrow-down"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="result-meta">
                                    <strong>Author of the Article:</strong> {{ $journal->authors ?? 'N/A' }}
                                </div>
                                <div class="result-meta">
                                    <strong>Title of the Article:</strong> {{ $journal->title }}
                                </div>
                                <div class="result-meta">
                                    <strong>Title of the Journal:</strong> {{ $journal->journal_name ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="ms-3">
                                @if(Auth::check() && Auth::user()->role === 'Working-Student')
                                    <form action="{{ route('journals.destroy', $journal->id) }}" method="POST" class="d-inline" onsubmit="event.stopPropagation(); return confirm('Submit a deletion request for this journal? The librarian will review it.');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.stopPropagation();">
                                            <i class="bi bi-send"></i> Request Deletion
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('journals.destroy', $journal->id) }}" method="POST" class="d-inline" onsubmit="event.stopPropagation(); return confirm('Delete this journal article permanently?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.stopPropagation();">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            @if(isset($totalResults) && $totalResults > 0)
                <div class="results-header">
                    <h3>Your search found {{ $totalResults }} result(s).</h3>
                </div>

                @if(($journals->count() ?? 0) > 0)
                    @foreach($journals as $journal)
                        <div class="result-item" data-type="journal" data-id="{{ $journal->id }}" onclick="showJournalDetail({{ $journal->id }})">
                            <div class="d-flex align-items-start">
                                <div class="doc-icon">
                                    <i class="bi bi-journal-arrow-down"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="result-meta">
                                        <strong>Author of the Article:</strong> {{ $journal->authors ?? 'N/A' }}
                                    </div>
                                    <div class="result-meta">
                                        <strong>Title of the Article:</strong> {{ $journal->title }}
                                    </div>
                                    @if(!empty($journal->source))
                                        <div class="result-meta">
                                            <strong>Source:</strong> "{{ $journal->source }}"
                                        </div>
                                    @endif
                                    <div class="result-meta">
                                        <strong>Title of the Journal:</strong> {{ $journal->journal_name ?? 'N/A' }}
                                    </div>
                                    <div class="result-meta">
                                        <strong>Abstract:</strong> "{{ \Illuminate\Support\Str::limit($journal->abstract, 250) ?: 'No abstract available.' }}"
                                    </div>
                                    <div class="result-meta">
                                        <strong>Subject:</strong> {{ $journal->subjects ?? ($journal->category_text ?? 'N/A') }}
                                    </div>
                                    <div class="result-meta">
                                        <strong>Note:</strong> {{ \Illuminate\Support\Str::limit($journal->description, 250) ?: 'No additional note available.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                @if(($theses->count() ?? 0) > 0)
                    @foreach($theses as $thesis)
                        <div class="result-item" data-type="thesis" data-id="{{ $thesis->id }}" onclick="showThesisDetail({{ $thesis->id }})">
                            <div class="d-flex align-items-start">
                                <div class="doc-icon">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="result-meta">
                                        <strong>Author:</strong> {{ $thesis->authors ?? 'N/A' }}
                                    </div>
                                    <div class="result-meta">
                                        <strong>Title:</strong> {{ $thesis->title }}
                                    </div>
                                    <div class="result-meta">
                                        <strong>Source:</strong> {{ $thesis->institution ?? 'N/A' }}
                                    </div>
                                    <div class="result-meta">
                                        <strong>Thesis Type:</strong> {{ $thesis->thesis_type ?? 'N/A' }} |
                                        <strong>Year:</strong> {{ $thesis->year ?? 'N/A' }} |
                                        <strong>Pages:</strong> {{ $thesis->pages ?? 'N/A' }}
                                    </div>
                                    <div class="result-meta">
                                        <strong>Abstract:</strong> {{ \Illuminate\Support\Str::limit($thesis->abstract, 250) ?: 'No abstract available.' }}
                                    </div>
                                    <div class="result-meta">
                                        <strong>Subject:</strong> {{ $thesis->subjects ?? ($thesis->category->category_name ?? 'N/A') }}
                                    </div>
                                    <div class="result-meta">
                                        <strong>Note:</strong> {{ \Illuminate\Support\Str::limit($thesis->description, 250) ?: 'No additional note available.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                

                @endif
            @elseif(!empty($query))
                <div class="no-results">
                    <i class="bi bi-search d-block"></i>
                    <h4>No results found for "{{ $query }}"</h4>
                    <p class="text-muted">Try refining your search or browse categories.</p>
                </div>
            @else
                <div class="no-results">
                    <i class="bi bi-journal-arrow-down d-block"></i>
                    <h4>Welcome to the E-Periodical Index</h4>
                    <p class="text-muted">Search for journals and theses using the search box above.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade detail-modal" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-light btn-sm" onclick="window.location.href='{{ route('search.index') }}'" aria-label="Back to Browse Resources">
                        <i class="bi bi-arrow-left"></i> Back
                    </button>
                    <h5 class="modal-title" id="detailModalLabel">Journal Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailModalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showJournalDetail(id) {
            const url = `{{ url('/journals') }}/${id}`;
            fetch(url + '?ajax=1', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('detailModalBody').innerHTML = html;
                document.getElementById('detailModalLabel').textContent = 'Journal Details';
                new bootstrap.Modal(document.getElementById('detailModal')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                window.open(url, '_blank');
            });
        }

        function showThesisDetail(id) {
            const url = `{{ url('/theses') }}/${id}`;
            fetch(url + '?ajax=1', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('detailModalBody').innerHTML = html;
                document.getElementById('detailModalLabel').textContent = 'Thesis Details';
                new bootstrap.Modal(document.getElementById('detailModal')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                window.open(url, '_blank');
            });
        }

    </script>
</body>
</html>
