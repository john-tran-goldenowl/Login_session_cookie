<form action="index.php?act=onupdate" method="POST">
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">ID</span>
        <input  type="text" value="<?=$account['id']?>" class="form-control" aria-label="Sizing example input"
            aria-describedby="inputGroup-sizing-default" disabled>
            <input type="hidden" name="id" value = "<?=$account['id']?>">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Account name</span>
        <input type="text" name="acc_name" value="<?=$account['acc_name']?>" class="form-control" aria-label="Sizing example input"
            aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Amount</span>
        <input type="text" name="amount" value="<?=$account['amount']?>" class="form-control" aria-label="Sizing example input"
            aria-describedby="inputGroup-sizing-default">
    </div>
    <input type="submit" class="btn btn-success" value="update">
 </form>
