@extends('layouts.main')

@section('title', "Lucky Page")

@section('content')
    <div class="position-absolute top-0 start-0 m-3">
        <a id="currentLink" class="me-2" href="{{ request()->fullUrl() }}" target="_blank">
            {{ request()->fullUrl() }}
        </a>
        <button id="generateBtn" class="btn btn-warning">Generate New</button>
        <button id="deactivateBtn" class="btn btn-danger">Deactivate Current</button>
    </div>
    <div class="text-center">
        <div class="mb-3">
            <button id="luckyBtn" class="btn btn-primary mt-5">I'm Feeling Lucky</button>
            <button id="historyBtn" class="btn btn-secondary mt-5 ml-5">History</button>
        </div>
        <div id="luckyResult" class="mt-3"></div>
    </div>
    <div class="position-absolute top-50 start-0 translate-middle-y ms-3">
        <div id="historyResult" class="mt-3"></div>
    </div>

@endsection
@section('script')
    <script>
        const hash = '{{$luckyPage->hash}}'; // Укажите нужный hash

        document.getElementById('luckyBtn').addEventListener('click', async function() {
            const response = await fetch(`/api/im-feeling-lucky/${hash}`);
            const data = await response.json();
            let color = data.result === "Win" ? "green" : "red";

            let html = `
    <p style="color: ${color};">Результат: ${data.result}</p>
    <p>Число: ${data.number}</p>
`;

            if(data.sum > 0){
                html += `<p>Сума: ${data.sum}</p>`;
            }
            document.getElementById('luckyResult').innerHTML = html;
        });

        document.getElementById('historyBtn').addEventListener('click', async function() {
            const response = await fetch(`/api/history/${hash}`);
            const history = await response.json();
            if(response.status !== 200){
                alert(history.message);
            }
            let historyHtml = '<h5>History</h5>';
            history.history.forEach(item => {
                historyHtml += `
                    <p><b>Result:</b> ${item.result}, <b>Number:</b> ${item.number}, <b>Sum:</b> ${item.sum}</p>
                `;
            });
            document.getElementById('historyResult').innerHTML = historyHtml;
        });

        document.getElementById('generateBtn').addEventListener('click', async function() {
            const response = await fetch(`/api/generate-lucky-page-link`);
            const data = await response.json();
            if(response.status !== 200){
                alert(data.message);
            }
            const linkElement = document.getElementById('currentLink');
            linkElement.textContent = data.link;
            linkElement.href = data.link;
        });

        document.getElementById('deactivateBtn').addEventListener('click', async function() {
            const response = await fetch(`/api/deactivate/${hash}`);
            const data = await response.json();
            if(response.status !== 200){
                alert(data.message);
            }
            if(data.success){
                const element = document.getElementById('deactivateBtn');
                element.textContent = 'Deactivated';
                element.classList.value = "btn btn-success";
                element.setAttribute("disabled", "true");
            }
        });
    </script>
@endsection
