<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-md-3">
            <ul class="loyalty-class">
            <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <li><a data-id="<?php echo e($card['barcode']); ?>"
                       data-company="<?php echo e($card['name']); ?>"
                       class="loyalty-card"
                       href="javascript:void(0)">
                        <img src="<?php echo e($card['logo']); ?>" class="img-circle img-responsive" /> <span><?php echo e($card['name']); ?></span></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 id="company"></h2>
            <div id="largeImage"></div>
        </div>
    </div>


    <script>
        window.onload = function() {

            $('.loyalty-card').click(function() {


                var newImg = '<img src="' + $(this).data('id') + '" alt="Loyalty Card" />';
                $('#largeImage').html(newImg);
                $("#company").text($(this).data('company'));



            });
        };
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['slug'=>'loyalty-cards'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>