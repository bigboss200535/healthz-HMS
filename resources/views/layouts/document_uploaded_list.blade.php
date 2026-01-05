                                             @if($documents && $documents->count() > 0)
                                                          <div class="table-responsive">
                                                              <table class="table table-hover">
                                                                  <thead>
                                                                      <tr>
                                                                          <th>Document Name</th>
                                                                          <th>Document Type</th>
                                                                          <th>Upload Date</th>
                                                                          <th>Size</th>
                                                                          <th>Actions</th>
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                      @foreach($documents as $document)
                                                                      <tr>
                                                                          <td>{{ $document->file_name }}</td>
                                                                          <td><span class="badge bg-label-primary">{{ strtoupper($document->document_type) }}</span></td>
                                                                          <td>{{ \Carbon\Carbon::parse($document->added_date)->format('d-m-Y') }}</td>
                                                                          <td>{{ number_format($document->file_size / 1024, 2) }} KB</td>
                                                                          <td>
                                                                                <div class="btn-group" role="group">
                                                                                     <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                                                                        <i class="bx bx-show"></i> View
                                                                                    </a>
                                                                                     <a href="{{ asset('storage/' . $document->file_path) }}" download="{{ $document->file_name }}" class="btn btn-sm btn-success">
                                                                                        <i class="bx bx-download"></i> Download
                                                                                     </a>
                                                                                    <button class="btn btn-sm btn-danger delete-document" data-id="{{ $document->documents_id }}">
                                                                                        <i class="bx bx-trash"></i> Delete
                                                                                    </button>
                                                                                </div>                    
                                                                          </td>
                                                                      </tr>
                                                                      @endforeach
                                                                  </tbody>
                                                              </table>
                                                          </div>
                                                      @else
                                                          <div class="alert alert-info">
                                                              No documents uploaded yet
                                                          </div>
                                                      @endif
                                            <!--  -->
