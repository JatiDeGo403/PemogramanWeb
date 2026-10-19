# Graph Report - jobsheet_6  (2026-10-14)

## Corpus Check
- Corpus is ~1,616 words - fits in a single context window. You may not need a graph.

## Summary
- 20 nodes · 41 edges · 3 communities (2 shown, 1 thin omitted)
- Extraction: 56% EXTRACTED · 39% INFERRED · 5% AMBIGUOUS · INFERRED: 16 edges (avg confidence: 0.88)
- Token cost: 0 input · 0 output

## Community Hubs (Navigation)
- app.js Global Utilities
- UI Pages & Styling
- Data Lists & Models

## God Nodes (most connected - your core abstractions)
1. `Data Barang List Page` - 9 edges
2. `Data Karyawan List Page` - 8 edges
3. `Tambah Karyawan Form Page` - 7 edges
4. `Tambah Barang Form Page` - 6 edges
5. `Beranda Dashboard Page` - 6 edges
6. `style.css Shared Stylesheet` - 5 edges
7. `tampilkanError()` - 3 edges
8. `hapusError()` - 3 edges
9. `initValidasiForm()` - 3 edges
10. `Barang Data Model` - 3 edges

## Surprising Connections (you probably didn't know these)
- `Data Barang List Page` --semantically_similar_to--> `Data Karyawan List Page`  [INFERRED] [semantically similar]
  Barang/list.html → karyawan/list.html
- `Tambah Barang Form Page` --semantically_similar_to--> `Tambah Karyawan Form Page`  [INFERRED] [semantically similar]
  Barang/tambah.html → karyawan/tambah.html
- `Data Barang List Page` --conceptually_related_to--> `Sistem Informasi Penjualan`  [INFERRED]
  Barang/list.html → index.html
- `Data Karyawan List Page` --conceptually_related_to--> `Sistem Informasi Penjualan`  [INFERRED]
  karyawan/list.html → index.html
- `Data Barang List Page` --shares_data_with--> `Barang Data Model`  [INFERRED]
  Barang/list.html → Barang/tambah.html

## Import Cycles
- None detected.

## Hyperedges (group relationships)
- **Sistem Informasi Penjualan Pages** — index, barang_list, barang_tambah, karyawan_list, karyawan_tambah [INFERRED 0.85]
- **Barang CRUD Flow** — barang_list, barang_tambah, asset_css_js_barang, barang_data_model [INFERRED 0.85]
- **Karyawan CRUD Flow** — karyawan_list, karyawan_tambah, asset_css_js_karyawan, karyawan_data_model [INFERRED 0.85]

## Communities (3 total, 1 thin omitted)

### Community 0 - "app.js Global Utilities"
Cohesion: 0.43
Nodes (3): hapusError(), initValidasiForm(), tampilkanError()

### Community 1 - "UI Pages & Styling"
Cohesion: 0.81
Nodes (7): style.css Shared Stylesheet, Data Barang List Page, Tambah Barang Form Page, Beranda Dashboard Page, Data Karyawan List Page, Tambah Karyawan Form Page, Sistem Informasi Penjualan

## Ambiguous Edges - Review These
- `app.js` → `Tambah Barang Form Page`  [AMBIGUOUS]
  Barang/tambah.html · relation: references
- `app.js` → `Tambah Karyawan Form Page`  [AMBIGUOUS]
  karyawan/tambah.html · relation: references

## Knowledge Gaps
- **1 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Data Barang List Page` connect `UI Pages & Styling` to `app.js Global Utilities`, `Data Lists & Models`?**
  _High betweenness centrality (0.236) - this node is a cross-community bridge._
- **Are the 4 inferred relationships involving `Data Barang List Page` (e.g. with `Barang Data Model` and `Tambah Barang Form Page`) actually correct?**
  _`Data Barang List Page` has 4 INFERRED edges - model-reasoned connections that need verification._
- **Why does `Data Karyawan List Page` connect `UI Pages & Styling` to `app.js Global Utilities`, `Data Lists & Models`?**
  _High betweenness centrality (0.217) - this node is a cross-community bridge._
- **Are the 4 inferred relationships involving `Data Karyawan List Page` (e.g. with `Data Barang List Page` and `Karyawan Data Model`) actually correct?**
  _`Data Karyawan List Page` has 4 INFERRED edges - model-reasoned connections that need verification._
- **Why does `Tambah Karyawan Form Page` connect `UI Pages & Styling` to `app.js Global Utilities`, `Data Lists & Models`?**
  _High betweenness centrality (0.063) - this node is a cross-community bridge._

### Low-confidence Hints
_AMBIGUOUS edges — the extractor was unsure. Verify before acting on these._

- **What is the exact relationship between `app.js` and `Tambah Barang Form Page`?**
  _Edge tagged AMBIGUOUS (relation: references) - confidence is low._
- **What is the exact relationship between `app.js` and `Tambah Karyawan Form Page`?**
  _Edge tagged AMBIGUOUS (relation: references) - confidence is low._