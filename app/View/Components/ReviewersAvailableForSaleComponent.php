<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ReviewersAvailableForSaleComponent extends Component
{
    public $reviewers;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->reviewers = \App\Reviewer::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
    
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header"><h4>Reviewers available for sale</h4></div>
                    <div class="card-body horizontal-scroll">
                        @foreach($reviewers as $index => $r)
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                            <div class="card-body wrapword">
                                <p class='name'>{{ $r->name }}</p>
                                <p class='selling-price'>
                                    {{ $r->price }}
                                    <button class='btn btn-danger' onclick="buyNow({{ $index }})">Buy Now</button>                                
                                </p> 
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> 
    
        <div class="modal fade" id="reviewerDetailModal" tabindex="-1" role="dialog" aria-labelledby="reviewerDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class='col-md-5'>
                                <img src="https://via.placeholder.com/300">
                            </div>                             
                            <div clas='col-md'>
                                <p class='reviewer-title'></p>
                                <p class='reviewer-content'></p>                                
                            </div>                            
                        </div>
                    </div>      
                    <div class='modal-footer'>
                        <input type='button' onclick='buyNow()' class="btn btn-success btn-lg btn-block" value='Buy Now' /> 
                    </div>
                </div>
            </div>
        </div>



        <script>
            var reviewers = {!! $reviewers !!}

            function openReviewerDetail(index)
            {

            }

            function buyNow(index)
            {
                const reviewer = reviewers[index]
                window.location = '/buyReviewer/' + reviewer.id;
            }
        </script>

        blade;
    }
}
