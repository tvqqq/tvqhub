<div id="app-vue-smallcaps">
    <div class="page-tools page-tools-smallcaps">
        <h1 class="mt-2 mb-4 text-info"><strong>Sᴍᴀʟʟᴄᴀᴘs</strong> Generator</h1>

        <div class="form-group">
            <label for="sc-input">Typing here:</label>
            <textarea id="sc-input" class="form-control" rows="4" v-model="scInput" @keyup="flip()"></textarea>
        </div>

        <div class="form-group">
            <label for="sc-output">Sᴍᴀʟʟᴄᴀᴘs:</label>
            <button class="btn btn-sm btn-outline-secondary ml-2" @click="copy"><i class="far fa-copy"></i> Copy</button>
            <textarea id="sc-output" class="form-control" rows="4" readonly="readonly" v-model="scOutput"></textarea>
        </div>
    </div>
</div>

<script>
    var app = new Vue({
        el: '#app-vue-smallcaps',
        data: function () {
            return {
                scInput: '',
                scOutput: ''
            }
        },
        methods: {
            flip: function () {
                this.scOutput = this.flipString(this.scInput);
            },
            flipString: function (str) {
                let last = str.length - 1;
                let result = new Array(str.length);
                for (let i = 0; i <= last; i++) {
                    let c = str.charAt(i);
                    let r = flipTable[c];
                    result[i] = r !== undefined ? r : c;
                }
                return result.join('');
            },
            copy() {
                jQuery('#sc-output').select();
                document.execCommand('copy');
            }
        }
    });

    const flipTable = {
        a: 'ᴀ',
        b: 'ʙ',
        c: 'ᴄ',
        d: 'ᴅ',
        e: 'ᴇ',
        f: 'ғ',
        g: 'ɢ',
        h: 'ʜ',
        i: 'ɪ',
        j: 'ᴊ',
        k: 'ᴋ',
        l: 'ʟ',
        m: 'ᴍ',
        n: 'ɴ',
        o: 'ᴏ',
        p: 'ᴘ',
        q: 'ǫ',
        r: 'ʀ',
        s: 's',
        t: 'ᴛ',
        u: 'ᴜ',
        v: 'ᴠ',
        w: 'ᴡ',
        x: 'x',
        y: 'ʏ',
        z: 'ᴢ'
    };
</script>
