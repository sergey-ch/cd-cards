<form action="/"  method="POST" enctype="multipart/form-data" id="card-form">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name"
               value="<?= $formData ? $formData->name : '' ?>">
    </div>

    <div class="form-group">
        <label for="artist">Artist</label>
        <input type="text" class="form-control" id="artist" name="artist"
               value="<?= $formData ? $formData->artist : '' ?>">
    </div>

    <div class="form-group">
        <label for="year">Year</label>
        <input type="number" class="form-control" id="year" name="year"
               value="<?= $formData ? $formData->year : '' ?>">
    </div>

    <div class="form-group">
        <label for="duration">Duration</label>
        <input type="number" class="form-control" id="duration" name="duration"
               value="<?= $formData ? $formData->duration : '' ?>">
    </div>

    <div class="form-group">
        <label for="buy_date">Buy date</label>
        <input type="date" class="form-control" id="buy_date" name="buy_date"
               value="<?= $formData ? date('Y-m-d', $formData->buy_date) : '' ?>">
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" step="0.01" min="0.00" class="form-control" id="price" name="price"
               value="<?= $formData ? $formData->price : '' ?>">
    </div>

    <div class="form-group">
        <label for="code">Code</label>
        <input type="text" class="form-control" id="code" name="code" placeholder="1:2:3"
               value="<?= $formData ? $formData->code : '' ?>">
    </div>

    <div class="form-group">
        <label>Cover</label>
        <div class="custom-file">
            <label for="img" class="custom-file-label"></label>
            <input type="file" class="custom-file-input" id="img" name="img">
        </div>
    </div>

    <input type="hidden" name="action" value="<?= $formData && $formData->getId() ? 'update' : 'create' ?>">
    <input type="hidden" name="id" value="<?= $formData ? $formData->getId() : '' ?>">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>