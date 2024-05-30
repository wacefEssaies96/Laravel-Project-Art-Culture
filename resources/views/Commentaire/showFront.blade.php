<ul class="col-12">
    <li class=" pe-2  align-items-center">
        <ul class=" px-2 py-3 me-sm-n4">
            <li class="mb-2">
                <a class="border-radius-md ">
                    <div class="row ">
                        <div class="d-flex flex-row-reverse justify-content-center">

                            @if(auth()->user() == $commentaire->user)
                            <div class="col-2">
                                <a href="{{ route('comment.edit', $commentaire->id) }}" class="btn btn-primary">
                                    <i class="far fa-edit"></i>
                                </a>
                            </div>
                            <div class="col-2">
                            <form action="{{ route('comment.destroy', $commentaire->id) }}" method="POST" id="deleteComment">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger "><i class="far fa-trash-alt "></i></button>
                                            </form>
                            </div>
                            @endif
                            <div class="col-4">
                                <p class="text-xs text-secondary mb-5">
                                    <i class="fa fa-clock me-1"></i>
                                    {{ $commentaire->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="col-4">
                                <img src="{{ asset('img/team-2.jpg') }}" class="avatar avatar-sm  me-3 ">
                                <span class="font-weight-bold ">{{$commentaire->user->username}}</span>
                            </div>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="d-flex flex-row-reverse justify-content-center">
                            <div class="col-4">
                                @php
                                $emojiCounts = [];
                                @endphp

                                @foreach ($commentaire->emojis as $emoji)
                                @php
                                $emj = $emoji->emj;
                                if (array_key_exists($emj, $emojiCounts)) {
                                $emojiCounts[$emj]++;
                                } else {
                                $emojiCounts[$emj] = 1;
                                }
                                @endphp
                                @endforeach
                                @php
                                arsort($emojiCounts);
                                @endphp
                                <ul>
                                    @foreach ($emojiCounts as $emj => $count)
                                    <span>{{ $emj }} {{ $count }}</span>
                                    @endforeach
                                </ul>
                            </div>
                            @if(count($emojis)>0&& $commentaire->ReplyTo!= "Comment")
                            <div class="col-1">
                                <form action="{{ route('removeEmoji') }}" method="POST">
                                    @csrf
                                    <div>
                                        <input type="hidden" value="{{$commentaire->id}}" name="cId">
                                    </div>
                                    <button class="btn btn-outline-primary" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16">
                                            <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <div class="col-2">
                                <form class="row" action="{{ route('addEmoji') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$commentaire->id}}" name="commentId">


                                    <button class="btn btn-outline-primary col-5" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                            <style>
                                                svg {
                                                    fill: #f09c0a
                                                }
                                            </style>
                                            <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z" />
                                        </svg>
                                    </button>

                                    <input class=" col-6 btn btn-outline-primary" id="emojiResult{{$comment->id}}" name="emojiEmj">
                                </form>
                            </div>
                            @endif
                            <div class="col-5">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    {{ $commentaire->Content }}
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex flex-row-reverse justify-content-center">
                            <form method="POST" action="{{ route('like', $commentaire->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-outline-success ">
                                    {{ $commentaire->Likes }}
                                    <svg style="color: green" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" fill="green"></path>
                                    </svg>
                                </button>
                            </form>
                            &nbsp;
                            <form method="POST" action="{{ route('dislike', $commentaire->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-outline-danger ">
                                    {{ $commentaire->Dislikes }}
                                    <svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                        <path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z" fill="red"></path>
                                    </svg>
                                </button>
                            </form>
                            &nbsp;
                            <div>
                                <button class="btn btn-outline-primary" id="showReplayofComment{{$commentaire->id}}">
                                    <svg style="color: #1f5122" xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" viewBox="0 0 512 512">
                                        <path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z" />
                                    </svg>
                                </button>
                            </div>
                            <script>
                                document.getElementById('showReplayofComment{{$commentaire->id}}').addEventListener('click', function() {

                                    const replayContainer = document.getElementById('replayContainer{{$commentaire->id}}');

                                    if (replayContainer.style.display === 'block') {
                                        replayContainer.style.display = 'none';
                                    } else {
                                        replayContainer.style.display = 'block';
                                    }
                                });
                            </script>
                            &nbsp;
                            <div id="comment_id" data-comment-id="{{$commentaire->id}}"></div>
                            @if(count($emojis)>0 && $commentaire->ReplyTo!= "Comment")
                            <div class="btn btn-outline-primary" style="height: 40px;" id="showEmojis{{$commentaire->id}}">+</div>
                            <div class="scrollable-div col-5" id="emojiContainer{{$commentaire->id}}"></div>
                            <script>
                                document.getElementById('showEmojis{{$commentaire->id}}').addEventListener('click', function() {

                                    const emojiContainer = document.getElementById('emojiContainer{{$commentaire->id}}');
                                    const commentIdElement = document.getElementById('comment_id');
                                    const comment_id = commentIdElement.getAttribute('data-comment-id');

                                    if (emojiContainer.style.display === 'block') {
                                        emojiContainer.style.display = 'none';
                                    } else {
                                        emojiContainer.style.display = 'block';

                                        const emojis = @json($emojis);

                                        emojis.forEach(function(emoji) {
                                            const emojiButton = document.createElement('button');
                                            emojiButton.setAttribute('class', 'btn btn-outline-primary');
                                            emojiButton.textContent = emoji.emj;
                                            emojiButton.addEventListener('click', function() {
                                                document.getElementById('emojiResult{{$commentaire->id}}').value = emoji.emj;
                                                // alert(' coment ' + comment_id + " emoji " + emoji.emj);
                                                emojiContainer.style.display = 'none';
                                            });
                                            if ((document.getElementById('emojiContainer{{$commentaire->id}}').innerHTML.length) < emojis.length * 50 //228
                                            ) {
                                                document.getElementById('emojiContainer{{$commentaire->id}}').appendChild(emojiButton);
                                            }
                                        });
                                    }
                                });
                            </script>
                            @endif

                        </div>

                    </div>
                </a>
            </li>
            <div id="replayContainer{{$commentaire->id}}" style="display: none;">
                <form action="{{ route('commentReplay') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$commentaire->id}}" name="rcId">
                    <input type="hidden" value="{{$ev->id}}" name="reId">
                    <div class="form-group mt-2">
                        <label for="example-text-input" class="form-control-label">Your Reply</label>
                        <textarea class="form-control" rows="3" type="text" name="ContentReplay"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Reply</button>
                </form>
            </div>
            @if (count($commentaire->replies) > 0)
            @foreach ($commentaire->replies as $commentReplie)
            <!-- admin
                @include('Commentaire.show', ['commentaire' => $commentReplie,'emojis' => $emojis])

         -->
         @include('Commentaire.showFront', ['commentaire' => $commentReplie,'emojis' => $emojis])

            @endforeach
            @endif
        </ul>
    </li>
</ul>