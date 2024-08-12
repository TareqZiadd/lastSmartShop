<?php require APPROOT . '/views/inc/header.php'; ?>


    <div class="card card-body bg-light mt-5" xmlns="http://www.w3.org/1999/html" >

        <h2  style="color:bisque;">Add product</h2>

        <?php if (isset($_GET['error'])): ?>
            <p><?php echo $_GET['error']; ?></p>
        <?php endif ?>

        <form action="<?php echo URLROOT ?>/product/add" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label >image </label>
                <input type="file" name="image_url" >
<br>
                <label for="name">: Name</label>
                <input
                    type="text"
                    name="name"
                    class="form-control form-control-lg
                             <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ?>"
                    value="<?php echo $data['name'] ?>"
                />
                <span class="invalid-feedback"><?php echo $data['name_err']?></span>
            </div>

            <div class="form-group">
                <label for="price">: Price<sup></sup></label>
                <input
                    type="text"
                    name="price"
                    class="form-control form-control-lg
                                   <?php echo (!empty($data['price_err'])) ? 'is-invalid' : '' ?>"
                    value="<?php echo $data['price'] ?>"
                />
                <span class="invalid-feedback"><?php echo $data['price_err']?></span>
            </div>

            <div class="form-group">
                <label for="quantity">:Quantity</label>
                <input
                    type="text"
                    name="quantity"
                    class="form-control form-control-lg
                                   <?php echo (!empty($data['quantity_err'])) ? 'is-invalid' : '' ?>"
                    value="<?php echo $data['quantity'] ?>"
                />
                <span class="invalid-feedback"><?php echo $data['quantity_err']?></span>
            </div>

            <div class="form-group">
                <label for="category" >:Category_type<sup>*</sup></label>
                <select id="category" name="category" required>
                    <option value="1">video games</option>
                    <option value="2">chargers</option>
                    <option value="3">laptop</option>
                    <option value="4">phone</option>
                    <option value="5">tablet</option>
                    <option value="6">camera</option>
                    <option value="7">watch</option>
                    <option value="8">headphone</option>
                    <option value="9">smart screen</option>

                </select>

            </div>

            <div class="form-group">
                <label for="body">Description: <sup>*</sup></label>
                <textarea
                    name="description"
                    class="form-control form-control-lg
                                   <?php echo (!empty($data['description_err'])) ? 'is-invalid' : '' ?>">
                         <?php echo $data['description']; ?> </textarea>
                <span class="invalid-feedback"><?php echo $data['description_err']?></span>
            </div>



            <input type="submit"  style="background-color:rgba(72,71,71,0.01);margin-left:230px;border-radius: 6px;font-size: 20px;color:bisque" class="add-to-cart text-center py-2 mr-1" value="Submit">
        </form>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>