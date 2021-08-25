<div>
    <x-partials.breadcrumb :title="__('my account')" />

    <div class="account-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    {{-- Nav tabs --}}
                    <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li>
                                <a href="#dashboard" data-bs-toggle="tab"
                                    class="nav-link btn btn-block btn-md btn-black-default-hover active"
                                    wire:ignore.self>
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                            <li>
                                @if ($myOrders->count())
                                    <a href="#orders" data-bs-toggle="tab"
                                        class="nav-link btn btn-block btn-md btn-black-default-hover" wire:ignore.self>
                                        Orders ({{ $myOrders->count() }})
                                    </a>
                                @else
                                    <a href="#orders" data-bs-toggle="tab"
                                        class="nav-link btn btn-block btn-md btn-black-default-hover not-allowed"
                                        wire:ignore.self>
                                        Orders
                                    </a>
                                @endif
                            </li>
                            <li>
                                <a href="#address" data-bs-toggle="tab"
                                    class="nav-link btn btn-block btn-md btn-black-default-hover" wire:ignore.self>
                                    Addresses
                                </a>
                            </li>
                            <li>
                                <a href="#account-details" data-bs-toggle="tab"
                                    class="nav-link btn btn-block btn-md btn-black-default-hover" wire:ignore.self>
                                    Account details
                                </a>
                            </li>
                            <li>
                                <a href="#edit-password" data-bs-toggle="tab"
                                    class="nav-link btn btn-block btn-md btn-black-default-hover" wire:ignore.self>
                                    Edit password
                                </a>
                            </li>
                            @if (!auth()->user()->hasVerifiedEmail())
                                <li>
                                    <a href="#verify-email" data-bs-toggle="tab"
                                        class="nav-link btn btn-block btn-md btn-black-default-hover" wire:ignore.self>
                                        Verify Email
                                    </a>
                                </li>
                            @endif
                            <li>
                                <livewire:auth.logout-component
                                    class="nav-link btn btn-block btn-md btn-black-default-hover" />
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    {{-- Tab panes --}}
                    <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                        <div class="tab-pane fade show active" id="dashboard" wire:ignore.self>
                            <h4>Dashboard </h4>
                            <h5 class='text-capitalize'>Hello {{ $user->name }}!!!</h5>
                            <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent
                                    orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a
                                    href="#">Edit your password and account details.</a></p>
                        </div>
                        <div class="tab-pane fade" id="orders" wire:ignore.self>
                            <h4>Orders</h4>
                            <div class="table_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Paid</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($myOrders as $order)
                                            <tr>
                                                <td>
                                                    <x-data.link route="order_history" :value="$order->order_code"
                                                        class="view">
                                                        {{ $order->order_code }}
                                                    </x-data.link>
                                                </td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    <i class="fa {{ $order->is_paid ? 'fa-check' : 'fa-times' }}"
                                                        aria-hidden="true"></i>
                                                </td>
                                                <td>
                                                    <span class="success">
                                                        {{ $order->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <x-data.price-order :order="$order" :value="$order->order_total" />
                                                    for {{ $order->items_count }}
                                                    item
                                                </td>
                                                <td>
                                                    <x-data.link class="view" route="order_history"
                                                        :value="$order->order_code">
                                                        view
                                                    </x-data.link>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="address" wire:ignore.self>
                            <livewire:auth.edit-address-component :user="$user" />
                        </div>
                        <div class="tab-pane fade" id="account-details" wire:ignore.self>
                            <h3>Account details </h3>
                            <livewire:auth.edit-detail-component :user="$user" />
                        </div>
                        <div class="tab-pane fade" id="edit-password" wire:ignore.self>
                            <h3>Edit password</h3>
                            <livewire:auth.edit-password-component :user="$user" />
                        </div>
                        @if (!auth()->user()->hasVerifiedEmail())
                            <div class="tab-pane fade show" id="verify-email" wire:ignore.self>
                                <h3>Verify email</h3>
                                <a class='view' href="{{ route('verification.notice') }}">
                                    Click to verify email
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('title', 'My Account')
