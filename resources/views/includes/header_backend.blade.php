<header class="u-header">
    <div class="u-header-left">
        <a class="u-header-logo" href="/dashboard">
            <img class="u-logo-desktop" src="{{ asset('/img/display-logo.png') }}" width="60" alt="Stream Dashboard">
            <img class="img-fluid u-logo-mobile" src="{{ asset('/img/display-logo.png') }}" width="50" alt="Stream Dashboard"> 
        </a>
    </div>

    <div class="u-header-middle">
        <a class="js-sidebar-invoker u-sidebar-invoker" href="#!" data-is-close-all-except-this="true" data-target="#sidebar">
            <i class="fa fa-bars u-sidebar-invoker__icon--open"></i>
            <i class="fa fa-times u-sidebar-invoker__icon--close"></i>
        </a>

        <div class="u-header-search" data-search-mobile-invoker="#headerSearchMobileInvoker" data-search-target="#headerSearch">
            <a id="headerSearchMobileInvoker" class="btn btn-link input-group-prepend u-header-search__mobile-invoker" href="#!">
                <i class="fa fa-search"></i>
            </a>

            <div id="headerSearch" class="u-header-search-form">
                <form>
                    <div class="input-group">
                        <button class="btn-link input-group-prepend u-header-search__btn" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        <input class="form-control u-header-search__field" type="search" placeholder="Type to search…">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="u-header-right">
        <!-- Activities -->
         <?php
         // Check if $unseens is set, if not, initialize it as an empty array
        $unseens = isset($unseens) ? $unseens : [];
         ?>
        <div class="dropdown mr-4">
            <a class="link-muted" href="#!" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                <span class="h3">
                    <i class="far fa-envelope"></i>
                </span>
                @if(count($unseens) > 0)
                <span class="u-indicator u-indicator-top-right u-indicator--xxs bg-secondary"></span>
                @endif
            </a>

            <div class="dropdown-menu dropdown-menu-right border-0 py-0 mt-4 bg-black" aria-labelledby="dropdownMenuLink" style="width: 360px;">
                <div class="card">
                    <div class="card-header d-flex align-items-center py-3">
                        <h2 class="h4 card-header-title">Activities</h2>
                        <a class="ml-auto custom-btn" href="javascript:void(0);">Clear all</a>
                    </div>

                    <div class="card-body p-0">
                        <div class="list-group list-group-flush custom-height">

                            <!-- create a forloop of unseen array  -->
                            @if(count($unseens) > 0) @foreach($unseens as $key => $unseen)
                            <!-- Activity -->
                            <a class="list-group-item list-group-item-action showEmail" data-orderid="{{ $unseen->id }}" href="javascript:void(0);">
                                <div class="media align-items-center">
                                    <img class="u-avatar--sm rounded-circle mr-3" src="{{asset('/img/avatars/img4.jpg')}}" alt="Image description">

                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <h4 class="mb-1">
                                                <!-- unseen firstname lastname -->
                                                {{ $unseen->firstname . ' ' . $unseen->lastname }}
                                            </h4>
                                            <small class="text-muted ml-auto">{{ date('d M Y', strtotime($unseen->date)) }}
                                            </small>
                                        </div>
                                        <p class="text-truncate mb-0 text-white" style="max-width: 250px;">
                                            Booking Received.
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- End Activity -->
                            @endforeach @endif
                        </div>
                    </div>

                    <div class="card-footer py-3">
                        @if(count($unseens) == 0)
                        <a class="btn btn-block btn-outline-primary" href="javascript:void(0);">No new activities</a>
                        @else
                        <a class="btn btn-block btn-outline-primary" href="/activities">View all activities</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- End Activities -->

        <!-- Notifications -->
        <div class="dropdown mr-4">
            <a class="link-muted" href="#!" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                <span class="h3">
                    <i class="far fa-bell"></i>
                </span>
                <span class="u-indicator u-indicator-top-right u-indicator--xxs bg-info"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right border-0 py-0 mt-4 bg-black" aria-labelledby="dropdownMenuLink" style="width: 360px;">
                <div class="card">
                    <div class="card-header d-flex align-items-center py-3">
                        <h2 class="h4 card-header-title">Notifications</h2>
                        <a class="ml-auto" href="#">Clear all</a>
                    </div>

                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <!-- Notification -->
                            <a class="list-group-item list-group-item-action" href="#">
                                <div class="media align-items-center">
                                    <div class="u-icon u-icon--sm rounded-circle bg-danger text-white mr-3">
                                        <i class="fab fa-dribbble"></i>
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <h4 class="mb-1">Dribbble</h4>
                                            <small class="text-muted ml-auto">23 Jan 2018</small>
                                        </div>

                                        <p class="text-truncate mb-0 text-white" style="max-width: 250px;">
                                            <span class="text-primary">@htmlstream</span> just liked your post!
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- End Notification -->

                            <!-- Notification -->
                            <a class="list-group-item list-group-item-action" href="#">
                                <div class="media align-items-center">
                                    <div class="u-icon u-icon--sm rounded-circle bg-info text-white mr-3">
                                        <i class="fab fa-twitter"></i>
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <h4 class="mb-1">Twitter</h4>
                                            <small class="text-muted ml-auto">18 Jan 2018</small>
                                        </div>

                                        <p class="text-truncate mb-0 text-white" style="max-width: 250px;">
                                            Someone mentioned you on the tweet.
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- End Notification -->

                            <!-- Notification -->
                            <a class="list-group-item list-group-item-action" href="#">
                                <div class="media align-items-center">
                                    <div class="u-icon u-icon--sm rounded-circle bg-success text-white mr-3">
                                        <i class="fab fa-spotify"></i>
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <h4 class="mb-1">Spotify</h4>
                                            <small class="text-muted ml-auto">18 Jan 2018</small>
                                        </div>

                                        <p class="text-truncate mb-0 text-white" style="max-width: 250px;">
                                            You've just recived $25 free gift card.
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- End Notification -->

                            <!-- Notification -->
                            <a class="list-group-item list-group-item-action" href="#">
                                <div class="media align-items-center">
                                    <div class="u-icon u-icon--sm rounded-circle bg-info text-white mr-3">
                                        <i class="fab fa-facebook-f"></i>
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <h4 class="mb-1">Facebook</h4>
                                            <small class="text-muted ml-auto">18 Jan 2018</small>
                                        </div>

                                        <p class="text-truncate mb-0 text-white" style="max-width: 250px;">
                                            <span class="text-primary">@htmlstream</span> commented in your post.
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- End Notification -->
                        </div>
                    </div>

                    <div class="card-footer py-3">
                        <a class="btn btn-block btn-outline-primary" href="/notifications">View all notifications</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Notifications -->

        <!-- Apps -->

        <!-- End Apps -->


        <!-- User Profile -->
        <div class="dropdown ml-2">
            <a class="link-muted d-flex align-items-center" href="#!" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                <img class="u-avatar--xs img-fluid rounded-circle mr-2" src="{{ asset('/img/avatars/img1.jpg') }}" alt="User Profile">
                <span class="text-white d-none d-sm-inline-block">
                    {{auth()->user()->name}} <small class="fa fa-angle-down text-muted ml-1"></small>
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-right border-0 py-0 mt-3 bg-black" aria-labelledby="dropdownMenuLink" style="width: 260px;">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-4">
                                <a class="d-flex align-items-center link-dark" href="#!">
                                    <span class="h3 mb-0"><i class="far fa-user-circle text-muted mr-2"></i></span>
                                    View Profile
                                </a>
                            </li>
                            <li class="mb-4">
                                <a class="d-flex align-items-center link-dark" href="/set-list">
                                    <span class="h3 mb-0"><i class="far fa-list-alt text-muted mr-2"></i></span>
                                    Settings
                                </a>
                            </li>
                            <li>
                                <a class="d-flex align-items-center link-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="h3 mb-0"><i class="far fa-share-square text-muted mr-2"></i></span> Sign Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End User Profile -->

    </div>

    <!-- Modal container (initially hidden) -->
    <div class="modal fade emailModal" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <input type="hidden" id="orderId" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Email Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Placeholder for unordered list -->
                    <div id="emailBody" class="emailBody"></div>
                </div>
            </div>
        </div>
    </div>

</header>

<script>
    // JavaScript
    document.querySelectorAll('.showEmail').forEach(function(button) {
        button.addEventListener('click', function() {
            const orderId = this.dataset.orderid;
            const url = `{{ url('/api/booking') }}/${orderId}`;
            // Use the orderId value as needed

            // Fetch the email template with the orderId
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const emailBody = document.getElementById('emailBody');
                    emailBody.innerHTML = data.html;
                    $('#orderId').val(orderId);

                    // Show the modal
                    $('#emailModal').modal('show');
                })
                .catch(error => console.error(error));
        });
    });

    // Add an event listener to the modal close button
    $('#emailModal').on('click', '.close', function() {
        const orderId = $('#orderId').val();
        const url = `{{ url('/api/booking') }}/${orderId}`;

        // Use the orderId value as needed

        // Send a PATCH request to update the booking status
        fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    is_seen: 1
                })
            })
            .then(response => {
                if (response.ok) {
                    console.log('Booking status updated successfully');
                    // Optionally, you can perform additional actions here
                    $(`.showEmail[data-orderid="${orderId}"]`).hide();
                } else {
                    console.error('Failed to update booking status');
                }
            })
            .catch(error => console.error(error));
    });
</script>