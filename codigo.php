<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Contratos & Licitações: Controle de Pleitos, Orçamentos e Documentação</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1e1b4b;
            --accent: #6366f1;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --background: #f8fafc;
            --surface: #ffffff;
            --border: #e2e8f0;
            --text: #0f172a;
            --text-muted: #64748b;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--background); color: var(--text); padding: 25px; line-height: 1.5; }
        .container { max-width: 1400px; margin: 0 auto; }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--primary);
            color: white;
            padding: 20px 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        header h1 { font-size: 1.5rem; font-weight: 700; }
        header p { color: #cbd5e1; font-size: 0.85rem; margin-top: 4px; }

        .toast {
            display: none;
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        .kpi-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .kpi-value { font-size: 1.8rem; font-weight: 700; color: var(--primary); margin: 5px 0; }
        .kpi-label { font-size: 0.8rem; font-weight: 600; color: var(--text-muted); }

        /* Layout Grid */
        .app-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }
        @media(max-width: 900px) { .app-grid { grid-template-columns: 1fr; } }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Formulários */
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }
        .form-group { display: flex; flex-direction: column; }
        .form-group.full-width { grid-column: 1 / -1; }
        label { font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 6px; }
        input, select, textarea {
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.9rem;
            outline: none;
            background: var(--background);
            transition: border-color 0.2s;
        }
        input:focus, select:focus, textarea:focus { border-color: var(--accent); background: #fff; }
        
        .btn {
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .btn:hover { opacity: 0.9; }
        .btn-warning { background: var(--warning); color: var(--primary); }
        .btn-danger { background: var(--danger); color: white; }

        /* Tabelas */
        .table-responsive { overflow-x: auto; margin-top: 15px; border-radius: 8px; border: 1px solid var(--border); }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.85rem; }
        th, td { padding: 12px 16px; border-bottom: 1px solid var(--border); }
        th { background: #f1f5f9; font-weight: 600; color: var(--text-muted); }
        tr:hover { background: #f8fafc; }

        /* Badges de Status */
        .badge { display: inline-block; padding: 4px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; text-align: center; }
        .badge-pendente { background: #fee2e2; color: #991b1b; }
        .badge-analise { background: #fef9c3; color: #854d0e; }
        .badge-aprovado { background: #dcfce7; color: #166534; }
        .badge-neutro { background: #f1f5f9; color: #475569; }

        /* Abas */
        .tabs { display: flex; gap: 10px; margin-bottom: 20px; border-bottom: 1px solid var(--border); padding-bottom: 5px; }
        .tab-btn {
            background: none;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }
        .tab-btn.active { color: var(--accent); border-bottom-color: var(--accent); }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body>

<div class="container">
    <header>
        <div>
            <h1>⚖️ E-Contratos & Comercial: Inteligência Comercial, Pleitos e Aditivos</h1>
            <p>Rastreabilidade de Evidências Jurídicas, Validação de Quantitativos de Licitação e Gestão de Impacto Financeiro</p>
        </div>
        <div style="font-size: 0.85rem; text-align: right;">
            <strong>Foco Jurídico:</strong> Prevenção de Passivos & Segurança Contratual<br>
            <strong>Ano Operacional:</strong> 2026
        </div>
    </header>

    <div id="toastMessage" class="toast"></div>

    <div class="dashboard-grid">
        <div class="kpi-card">
            <div class="kpi-label">Volume de Aditivos Pendentes</div>
            <div class="kpi-value" id="kpiValorAditivos" style="color: var(--warning);">R$ 0,00</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-label">Pleitos Registrados (Evidências)</div>
            <div class="kpi-value" id="kpiPleitosAtivos" style="color: var(--danger);">0</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-label">Licitações em Fase de Habilitação</div>
            <div class="kpi-value" id="kpiLicitacoesAtivas">0</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-label">Conformidade das Propostas</div>
            <div class="kpi-value" style="color: var(--success);">100% Auditada</div>
        </div>
    </div>

    <div class="app-grid">
        
        <div class="card">
            <div class="card-title">⚖️ Engenharia Contratual: Registrar Pleito / Aditivo</div>
            <form id="formPleito">
                <div class="form-row">
                    <div class="form-group">
                        <label for="contratoNome">Contrato / Empreendimento</label>
                        <input type="text" id="contratoNome" required placeholder="Ex: Ampliação BR-101 / Consórcio Sinos">
                    </div>
                    <div class="form-group">
                        <label for="tipoSolicitacao">Tipo de Modificação de Escopo</label>
                        <select id="tipoSolicitacao" required>
                            <option value="Pleito Financeiro (Atraso de Escopo)">Pleito Financeiro (Atraso de Escopo)</option>
                            <option value="Aditivo Contratual (Aumento de Escopo)">Aditivo Contratual (Aumento de Escopo)</option>
                            <option value="Serviço Extracontratual (Fora do Escopo Inicial)">Serviço Extracontratual (Fora do Escopo Inicial)</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="impactoFinanceiro">Impacto Financeiro Estimado (R$)</label>
                        <input type="number" id="impactoFinanceiro" min="0" required placeholder="Ex: 450000">
                    </div>
                    <div class="form-group">
                        <label for="impactoPrazo">Impacto no Cronograma Geral (Dias)</label>
                        <input type="number" id="impactoPrazo" min="0" required placeholder="Ex: 30">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="linkEvidencias">Link Oficial de Evidências (Fotos, RDO, E-mails)</label>
                        <input type="url" id="linkEvidencias" required placeholder="Ex: https://sharepoint.com/pasta-evidencias">
                    </div>
                    <div class="form-group">
                        <label for="statusAprovacao">Status de Homologação do Cliente</label>
                        <select id="statusAprovacao" required>
                            <option value="Aguardando Aprovação">Aguardando Aprovação (Gargalo de Prazo)</option>
                            <option value="Em Discussão Técnica">Em Discussão Técnica</option>
                            <option value="Aprovado e Assinado">Aprovado e Assinado</option>
                        </select>
                    </div>
                </div>
                <div class="form-group full-width" style="margin-bottom: 15px;">
                    <label for="motivoPleito">Descrição Detalhada do Impacto / Causa Raiz do Evento</label>
                    <textarea id="motivoPleito" required placeholder="Descreva os fatos geradores e o embasamento contratual aplicável..."></textarea>
                </div>
                <button type="submit" class="btn">Protocolar Evento Contratual</button>
            </form>
        </div>

        <div class="card">
            <div class="card-title">💼 Comercial & Licitações: Estudo de Proposta e Checklist</div>
            <form id="formLicitacao">
                <div class="form-row">
                    <div class="form-group">
                        <label for="licitacaoNome">Identificação da Licitação / Edital</label>
                        <input type="text" id="licitacaoNome" required placeholder="Ex: Edital 043/2026 - Metrô Linha 2">
                    </div>
                    <div class="form-group">
                        <label for="statusEstudo">Análise de Escopo e Quantitativos</label>
                        <select id="statusEstudo" required>
                            <option value="Quantitativos Auditados (Consistentes)">Quantitativos Auditados (Consistentes)</option>
                            <option value="Divergência Encontrada (Margem Curta)">⚠️ Divergência Encontrada (Margem Curta)</option>
                            <option value="Falta Informações Claras">❌ Falta Informações Claras (Risco Comercial)</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="precoTeto">Orçamento Base do Cliente (R$)</label>
                        <input type="number" id="precoTeto" min="1" required placeholder="Ex: 12000000">
                    </div>
                    <div class="form-group">
                        <label for="margemMinima">Margem de Lucro Planejada (%)</label>
                        <input type="number" id="margemMinima" min="1" required placeholder="Ex: 12">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="docChecklist">Status do Checklist de Habilitação</label>
                        <select id="docChecklist" required>
                            <option value="Completo (Sem pendências)">Completo (Habilitação Segura)</option>
                            <option value="Pendente Certidão Técnica">Pendente Certidões Técnicas (CAT/Anotações)</option>
                            <option value="Aguardando Jurídico">Aguardando Jurídico / Seguros</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="estrategiaPreco">Estratégia contra Concorrência Agressiva</label>
                        <select id="estrategiaPreco" required>
                            <option value="Foco na Qualidade e CAT (Diferencial Técnico)">Foco na Qualidade e CAT (Diferencial Técnico)</option>
                            <option value="Desconto Limite (Guerra de Preço Controlada)">Desconto Limite (Guerra de Preço Controlada)</option>
                            <option value="Proposta Segura com Contingência">Proposta Segura com Contingência</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning">Salvar Análise de Oportunidade comercial</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="tabs">
            <button class="tab-btn active" onclick="switchTab('pleitos-painel')">⚖️ Livro de Registro de Pleitos & Evidências Contratuais</button>
            <button class="tab-btn" onclick="switchTab('licitacoes-painel')">💼 Funil de Licitações & Mitigação de Riscos de Preço</button>
        </div>

        <div id="pleitos-painel" class="tab-content active">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Contrato / Empreendimento</th>
                            <th>Modificação Solicitada</th>
                            <th>Impacto Prazo</th>
                            <th>Impacto Financeiro</th>
                            <th>Dossiê / Evidências</th>
                            <th>Histórico e Fatos Geradores</th>
                            <th>Status de Aprovação</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody id="tabelaPleitos">
                        </tbody>
                </table>
            </div>
        </div>

        <div id="licitacoes-painel" class="tab-content">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Identificação da Oportunidade</th>
                            <th>Análise Técnica (Quantitativos)</th>
                            <th>Orçamento Base</th>
                            <th>Meta de Margem</th>
                            <th>Habilitação Documental</th>
                            <th>Defesa Comercial</th>
                        </tr>
                    </thead>
                    <tbody id="tabelaLicitacoes">
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // ==========================================
    // PERSISTÊNCIA DOS DADOS (LOCALSTORAGE)
    // ==========================================
    let contratosDados = JSON.parse(localStorage.getItem('contratos_db')) || {
        pleitos: [
            { id: 1, contrato: "Subestação de Energia Norte", tipo: "Pleito Financeiro (Atraso de Escopo)", custo: 320000, prazo: 45, link: "https://drive.google.com/drive/folders/1", descricao: "Atraso na liberação da licença ambiental pelo cliente, paralisando frentes de terraplanagem.", status: "Aguardando Aprovação" },
            { id: 2, contrato: "Ampliação Galpão de Distribuição", tipo: "Aditivo Contratual (Aumento de Escopo)", custo: 185000, prazo: 15, link: "https://drive.google.com/drive/folders/2", descricao: "Inclusão de reforço estrutural não contemplado no projeto de edital original.", status: "Aprovado e Assinado" }
        ],
        licitacoes: [
            { id: 1, identificacao: "Licitação Metroviária - Linha 4", analise: "Quantitativos Auditados (Consistentes)", teto: 24000000, margem: 15, habilitacao: "Completo (Sem pendências)", estrategia: "Foco na Qualidade e CAT (Diferencial Técnico)" },
            { id: 2, identificacao: "Saneamento Básico Setor Oeste", analise: "Divergência Encontrada (Margem Curta)", teto: 4500000, margem: 10, habilitacao: "Pendente Certidão Técnica", estrategia: "Proposta Segura com Contingência" }
        ]
    };

    function salvarDadosLocal() {
        localStorage.setItem('contratos_db', JSON.stringify(contratosDados));
        atualizarPainelContratos();
    }

    function exibirToast(texto) {
        const toast = document.getElementById("toastMessage");
        toast.innerText = texto;
        toast.style.display = "block";
        setTimeout(() => { toast.style.display = "none"; }, 4000);
    }

    // ==========================================
    // TRATADORES DOS FORMULÁRIOS
    // ==========================================

    // Form 1: Lançar Pleitos / Aditivos
    document.getElementById("formPleito").addEventListener("submit", function(e) {
        e.preventDefault();

        contratosDados.pleitos.push({
            id: Date.now(),
            contrato: document.getElementById("contratoNome").value,
            tipo: document.getElementById("tipoSolicitacao").value,
            custo: parseFloat(document.getElementById("impactoFinanceiro").value),
            prazo: parseInt(document.getElementById("impactoPrazo").value),
            link: document.getElementById("linkEvidencias").value,
            descricao: document.getElementById("motivoPleito").value,
            status: document.getElementById("statusAprovacao").value
        });

        salvarDadosLocal();
        document.getElementById("formPleito").reset();
        exibirToast("Dossiê de Pleito/Aditivo registrado para defesa jurídica!");
    });

    // Form 2: Lançar Licitações
    document.getElementById("formLicitacao").addEventListener("submit", function(e) {
        e.preventDefault();

        contratosDados.licitacoes.push({
            id: Date.now(),
            identificacao: document.getElementById("licitacaoNome").value,
            analise: document.getElementById("statusEstudo").value,
            teto: parseFloat(document.getElementById("precoTeto").value),
            margem: parseFloat(document.getElementById("margemMinima").value),
            habilitacao: document.getElementById("docChecklist").value,
            estrategia: document.getElementById("estrategiaPreco").value
        });

        salvarDadosLocal();
        document.getElementById("formLicitacao").reset();
        exibirToast("Licitação mapeada e estruturada para análise de riscos!");
    });

    // Alterar status de aprovação de pleito
    function aprovarPleito(id) {
        const pleito = contratosDados.pleitos.find(p => p.id === id);
        if (pleito) {
            pleito.status = "Aprovado e Assinado";
            salvarDadosLocal();
            exibirToast("Pleito/Aditivo aprovado! Equilíbrio financeiro restabelecido.");
        }
    }

    // ==========================================
    // REFRESH VISUAL DA INTERFACE
    // ==========================================
    function atualizarPainelContratos() {
        // 1. Atualizar KPIs do Painel Superior
        const totalAditivosPendentes = contratosDados.pleitos
            .filter(p => p.status !== "Aprovado e Assinado")
            .reduce((acc, curr) => acc + curr.custo, 0);

        const pleitosContagem = contratosDados.pleitos.length;
        const licitacoesContagem = contratosDados.licitacoes.length;

        // Formatação de Moeda Brasileira (BRL)
        document.getElementById("kpiValorAditivos").innerText = totalAditivosPendentes.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        document.getElementById("kpiPleitosAtivos").innerText = pleitosContagem;
        document.getElementById("kpiLicitacoesAtivas").innerText = licitacoesContagem;

        // 2. Renderizar Tabela de Pleitos e Aditivos (Engenharia Contratual)
        const tbodyP = document.getElementById("tabelaPleitos");
        tbodyP.innerHTML = "";
        contratosDados.pleitos.forEach(p => {
            let badgeClass = "badge-pendente";
            if (p.status === "Aprovado e Assinado") badgeClass = "badge-aprovado";
            if (p.status === "Em Discussão Técnica") badgeClass = "badge-analise";

            const btnAcao = p.status !== "Aprovado e Assinado" ? `<button class="btn" style="padding: 4px 8px; font-size: 0.7rem; background: var(--success);" onclick="aprovarPleito(${p.id})">Assinar</button>` : `<span style="color: var(--success); font-weight: bold;">Sim</span>`;

            tbodyP.innerHTML += `
                <tr>
                    <td><strong>${p.contrato}</strong></td>
                    <td>${p.tipo}</td>
                    <td>⚠️ +${p.prazo} dias</td>
                    <td><strong>${p.custo.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}</strong></td>
                    <td><a href="${p.link}" target="_blank" style="color: var(--accent); font-weight: bold; text-decoration: none;">🔗 Dossiê de Provas</a></td>
                    <td style="max-width: 250px; white-space: normal;">${p.descricao}</td>
                    <td><span class="badge ${badgeClass}">${p.status}</span></td>
                    <td>${btnAcao}</td>
                </tr>
            `;
        });

        // 3. Renderizar Tabela de Licitações (Estudos Comerciais)
        const tbodyL = document.getElementById("tabelaLicitacoes");
        tbodyL.innerHTML = "";
        contratosDados.licitacoes.forEach(l => {
            let analiseBadge = "badge-aprovado";
            if (l.analise.includes("Divergência")) analiseBadge = "badge-analise";
            if (l.analise.includes("Falta Informações")) analiseBadge = "badge-pendente";

            let docBadge = "badge-aprovado";
            if (l.habilitacao.includes("Pendente") || l.habilitacao.includes("Aguardando")) docBadge = "badge-analise";

            tbodyL.innerHTML += `
                <tr>
                    <td><strong>${l.identificacao}</strong></td>
                    <td><span class="badge ${analiseBadge}">${l.analise}</span></td>
                    <td><strong>${l.teto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}</strong></td>
                    <td>📈 ${l.margem}%</td>
                    <td><span class="badge ${docBadge}">${l.habilitacao}</span></td>
                    <td>⚔️ ${l.estrategia}</td>
                </tr>
            `;
        });
    }

    // Gerenciador de Abas de Navegação
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        
        document.getElementById(tabId).classList.add('active');
        event.currentTarget.classList.add('active');
    }

    // Inicialização da Página
    document.addEventListener("DOMContentLoaded", () => {
        atualizarPainelContratos();
    });
</script>
</body>
</html>