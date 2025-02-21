<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentationRepo;

class DocumentationRepoController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $keywords = DocumentationRepo::where('keyword', 'like', "%$query%")
            ->get();

        return response()->json($keywords);
    }
}

// <textarea id="documentation" rows="10" cols="50"></textarea>
// <p>Start typing to fetch relevant keywords:</p>
// <input type="text" id="keywordInput" placeholder="Type a keyword...">
// <ul id="keywordList"></ul>

// <script>
//     $(document).ready(function() {
//         $('#keywordInput').on('input', function() {
//             var query = $(this).val();
//             if (query.length >= 2) {
//                 $.ajax({
//                     url: "{{ route('fetch.keywords') }}",
//                     type: "GET",
//                     data: { query: query },
//                     success: function(response) {
//                         $('#keywordList').empty();
//                         response.forEach(function(keyword) {
//                             $('#keywordList').append('<li>' + keyword.keyword + ' - ' + keyword.template + '</li>');
//                         });
//                     }
//                 });
//             } else {
//                 $('#keywordList').empty();
//             }
//         });

//         $('#keywordList').on('click', 'li', function() {
//             var template = $(this).text().split(' - ')[1];
//             $('#documentation').val($('#documentation').val() + template + '\n');
//         });
//     });
// </script>