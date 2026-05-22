# Reports Skill
Loads when: reports, analytics, exports, dashboards

## Rules
- All reports via ReportService
- Always accept date_from and date_to
- Always scope by tenant_id (except admin reports)
- Cache heavy reports for 10 minutes
- Chunk large datasets — never load all at once
- Export: PDF (DomPDF) + Excel (Laravel Excel)
